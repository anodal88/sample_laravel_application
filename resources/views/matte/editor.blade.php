@extends('layouts.app')
@section('htmlheader_title')
    User
@endsection

@section('main-content')
    <form method="post" id="mette_send" action="mette_save">
        {{ csrf_field() }}
        <textarea class="my-editor" id="html_mette" name="content"></textarea>
    </form>

@endsection

@section('add_scripts')
    <script src="{{ asset('/plugins/tinymce/tinymce.min.js') }}"></script>
    {{--<script src="{{ asset('/plugins/html2canvas/html2canvas.js') }}"></script>--}}
    {{--<script src="{{ asset('/plugins/dom-to-image-2.5.2/src/dom-to-image.js') }}"></script>--}}
    <script type="application/javascript">

//        function convert(html) {
//            domtoimage.toPng(html)
//                    .then(function (dataUrl) {
//                        var img = new Image();
//                        img.src = dataUrl;
//                        console.log(img);
//                    })
//                    .catch(function (error) {
//                        console.error('oops, something went wrong!', error);
//                    });
//        }
        var editor_config = {
            path_absolute: "{{URL::to('/mette/editor_index')}}/",
            selector: "textarea.my-editor",
            height: 600,
            forced_root_block: false,

            plugins: [
                'autolink link image  preview anchor imagetools',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime table contextmenu paste code save autoresize'
//                "autoresize template save table preview code paste example rocco_reby autosave bbcode textcolor visualblocks imagetools image"
//                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
//                "searchreplace wordcount visualblocks visualchars code fullscreen",
//                "insertdatetime media nonbreaking  table contextmenu directionality",
//                "emoticons template paste textcolor colorpicker textpattern"
//                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
//                "searchreplace wordcount visualblocks visualchars code fullscreen",
//                "insertdatetime media nonbreaking save table contextmenu directionality",
//                "emoticons template  textcolor colorpicker textpattern"
            ],
            image_advtab: true,
            save_enablewhendirty: true,
            save_onsavecallback: function () {
                var token = $('input[name="_token"]').val();
                var schema = new tinymce.html.Schema(tinymce.settings);
                var parser = new tinymce.html.DomParser({}, schema);
                var rootNode = parser.parse(tinyMCE.activeEditor.getContent());


                if (rootNode.getAll('table').length > 1 || rootNode.getAll('img').length == 0) {
                    alert('Esta mal formada esta plantilla');
                } else {
                    function rowspan(elemnt) {
                        if (elemnt.parent().attr('rowspan') !== undefined) {
                            return elemnt.parent().attr('rowspan');
                        }
                        return 0;
                    }

                    function convert_in(value) {
                        return (value.replace(/px$/, '') / 96).toFixed(1)
                    }

                    function mergeMargins(margin) {

                        var splitMargin = margin.split(" ");
                        css = [];

                        switch (splitMargin.length) {
                            case 1: //margin: toprightbottomleft;
                                css['margin-top'] = splitMargin[0] == 'auto' ? 0 : convert_in(splitMargin[0]);
                                css['margin-right'] = splitMargin[0] == 'auto' ? 0 : convert_in(splitMargin[0]);
                                css['margin-bottom'] = splitMargin[0] == 'auto' ? 0 : convert_in(splitMargin[0]);
                                css['margin-left'] = splitMargin[0] == 'auto' ? 0 : convert_in(splitMargin[0]);
                                break;
                            case 2: //margin: topbottom rightleft;
                                css['margin-top'] = splitMargin[0] == 'auto' ? 0 : convert_in(splitMargin[0]);
                                css['margin-right'] = splitMargin[1] == 'auto' ? 0 : splitMargin[1];
                                css['margin-bottom'] = splitMargin[0] == 'auto' ? 0 : convert_in(splitMargin[0]);
                                css['margin-left'] = splitMargin[1] == 'auto' ? 0 : splitMargin[1];
                                break;
                            case 3: //margin: top rightleft bottom;
                                css['margin-top'] = splitMargin[0] == 'auto' ? 0 : convert_in(splitMargin[0]);
                                css['margin-right'] = splitMargin[1] == 'auto' ? 0 : convert_in(splitMargin[1]);
                                css['margin-bottom'] = splitMargin[2] == 'auto' ? 0 : convert_in(splitMargin[2]);
                                css['margin-left'] = splitMargin[1] == 'auto' ? 0 : convert_in(splitMargin[1]);
                                break;
                            case 4: //margin: top right bottom left;
                                css['margin-top'] = splitMargin[0] == 'auto' ? 0 : convert_in(splitMargin[0]);
                                css['margin-right'] = splitMargin[1] == 'auto' ? 0 : convert_in(splitMargin[1]);
                                css['margin-bottom'] = splitMargin[2] == 'auto' ? 0 : convert_in(splitMargin[2]);
                                css['margin-left'] = splitMargin[3] == 'auto' ? 0 : convert_in(splitMargin[3]);
                        }
                        return css;
                    }

                    function colspan(elemnt) {
                        if (elemnt.parent().attr('colspan') !== undefined) {
                            return elemnt.parent().attr('colspan');
                        }
                        return 0;
                    }

                    function verticalidad(elemt) {

                        if (elemt.width() >= elemt.height()) {
                            return "Landscape";
                        } else {
                            return "Portrait";
                        }
                    }


                    function verticalidad_width_height(width, height) {

                        if (width >= height) {
                            return "Horizontal";
                        } else {
                            return "Vertical";
                        }
                    }

                    function name_img(corner_radius, vert, width, height) {
                        name = "";
                        if (corner_radius == '0.0') {
                            name += "S";
                        } else {
                            name += "C";
                        }

                        name += vert.charAt(0).toUpperCase();
                        name += " ";
                        name += width + "x" + height;
                        return name;


                    }

                    function name_ep(corner_radius) {
                        name = "";
                        if (corner_radius == '0.0') {
                            name += "SEP";
                        } else {
                            name += "CEP";
                        }
                        return name;
                    }


                    html = $($.parseHTML(tinymce.activeEditor.getContent()));
//                    console.log($.parseHTML(tinymce.activeEditor.getContent())[0]);
//                    html = html.attr('id', "my_table");
//                    console.log(html);
//
//                 convert($.parseHTML(tinymce.activeEditor.getContent())[0]);

                    var img = [];
                    $.each(html.find("img"), function (index, value) {
                        var margin = mergeMargins($(value).css('margin'));

                        var $d = $(value).parent("td");

                        var col = $d.parent().children().index($d);

                        var row = $d.parent().parent().children().index($d.parent());

                        var name = "";

                        var vert = verticalidad($(value));
                        var corner_radius = convert_in($(value).css('border-radius'));
                        var width = ($(value).width() / 96).toFixed(1);
                        var height = ($(value).height() / 96).toFixed(1);

                        if ($(value).attr("alt") == 'Image') {
                            name = name_img(corner_radius, vert, width, height);
                        } else {
                            name = name_ep(corner_radius);
                        }

                        img[index] = {
                            'type': $(value).attr("alt"),
                            'order': (index + 1),
                            'name': name,
                            'cornerRadio': corner_radius,
                            'orientation': vert,
                            'width': width,
                            'height': height,
                            'colspan': colspan($(value)),
                            'rowspan': rowspan($(value)),
                            'marginTop': margin['margin-top'],
                            'marginRight': margin['margin-right'],
                            'marginBottom': margin['margin-bottom'],
                            'marginLeft': margin['margin-left'],
                            'row': (row + 1),
                            'column': (col + 1)
                        };

                    });

                    function dialog_info() {
                        var info_dialog = {
                            title: 'Save',
                            bodyType: 'tabpanel',
                            body: [
                                {
                                    title: 'Information',
                                    type: 'form',
                                    pack: 'start',
                                    items: [

                                        {
                                            type: 'container',
                                            columns: 3,
                                            label: 'Matte Outter size *',
                                            layout: 'grid',
                                            alignH: ['left', 'center', 'right'],
                                            items: [
                                                {
                                                    name: 'width',
                                                    type: 'textbox',
                                                    maxLength: 5,
                                                    size: 3,
                                                    ariaLabel: 'Width'
                                                },
                                                {type: 'label', text: 'x'},
                                                {
                                                    name: 'height',
                                                    type: 'textbox',
                                                    maxLength: 5,
                                                    size: 3,
                                                    ariaLabel: 'Height'
                                                },
                                            ]
                                        }, {
                                            type: 'form',
                                            layout: 'grid',
                                            packV: 'start',
                                            columns: 2,
                                            padding: 0,
                                            alignH: ['left', 'right'],
                                            defaults: {
                                                type: 'textbox',
                                                maxWidth: 50,
                                            },
                                            items: [
                                                {label: 'Box # for shipping *', name: 'num_box'},
                                                {label: 'Border Matte *', name: 'border_matte'},
                                            ]
                                        }
                                    ]
                                }
                            ],
                            onSubmit: onSubmitForm
                        };


                        win = tinyMCE.activeEditor.windowManager.open(info_dialog);
                    }

                    dialog_info();

                    function onSubmitForm() {
                        var data = win.toJSON();
                        var matte = {};

                        if (data.width > 0 || data.height > 0 || data.border_matte != "(an empty string)" || data.num_box != "(an empty string)") {
                            var name_image = "";
                            var vert_first = "";
                            $.each(img, function (index, value) {
                                name_image += value.name + " ";
                                vert_first += value.orientation.charAt(0).toUpperCase();

                            });

                            var mate_verticalidad = verticalidad_width_height(data.width, data.height).charAt(0).toUpperCase();
//                            console.log($.parseHTML(tinymce.activeEditor.getContent().toString()));
                            matte = {

                                'name': "T" + data.num_box + " " + vert_first + mate_verticalidad + " " + name_image + img.length + "W " + "B" + data.num_box,
                                'row': html.find('tr').length,
                                'columns': html.find("tr:last td").length,
                                'width': data.width,
                                'height': data.height,
                                'orientation': verticalidad_width_height(data.width, data.height),
                                'margin': data.border_matte,
                                'num_box': data.num_box,
                                'html_template': tinymce.activeEditor.getContent(),

                            };

                            $.ajax({
                                type: 'POST',
                                headers: {'X-CSRF-TOKEN': token},
                                cache: false,
                                url: 'store',
                                data: {
                                    img: img,
                                    matte: matte
                                },


                                success: function (data) {


                                    if (data['status'] == 'failure') {
                                        tinyMCE.activeEditor.windowManager.alert(data['message']);
                                    } else {
                                        if (data['status'] == "success") {
                                            tinyMCE.activeEditor.windowManager.confirm("New Template", function (s) {
                                                if (s)
                                                    dialog_info();
                                                else
                                                    tinyMCE.activeEditor.windowManager.alert("Cancel");
                                            });
                                        }
                                    }

                                },
                                error: function (req, status, err) {
                                    console.log('something went wrong', status, err);
                                    msg('error', 'error');
                                }

                            });


                        } else {
                            tinyMCE.activeEditor.windowManager.confirm("Your data is incorrect, try wants to", function (s) {
                                if (s)
                                    dialog_info();
                                else
                                    tinyMCE.activeEditor.windowManager.alert("Cancel");
                            });


                        }

//                        var row = html.find('tr').length;
//                        var nColumnas = html.find("tr:last td").length;
//                        var msg = "Filas: " + nFilas + " - Columnas: " + nColumnas;

//                        console.log(matte);


                    }

//                    nodes=rootNode.getAll('table');
//                    console.debug(nodes.filterNode('img'));

//                    var i = 1;
//                    var image = "";

//                    $.each(rootNode.getAll('table').getAll('img'), function (index) {
//                        $.each(index.attributes.map, function (index, value) {
//                            if (index == 'alt') {
//                                if (value != image) {
//                                    i++;
//                                    image = value;
//                                }
//
//                            }
//                            console.log(index + ": " + value);
//                        });
//                    });
                }


//                parser.addAttributeFilter('img,table', function(nodes, name) {
//                    for (var i = 0; i < nodes.length; i++) {
//                        console.log(nodes[i].name);
//                    }
//                });


            },
            toolbar: "save | insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | preview media | image",
            relative_urls: true,
            image_list: [
                {title: 'Image', value: "{{ asset('img/boxed-bg.jpg') }}"},
                {title: 'Engraved Plates', value: "{{ asset('img/boxed-bg.png') }}"},
            ],

//            file_browser_callback: function (field_name, url, type, win) {
//                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
//                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
//
//                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
//                if (type == 'image') {
//                    cmsURL = cmsURL + "&type=Images";
//                } else {
//                    cmsURL = cmsURL + "&type=Files";
//                }
//
//                tinyMCE.activeEditor.windowManager.open({
//                    file: cmsURL,
//                    title: 'Filemanager',
//                    width: x * 0.8,
//                    height: y * 0.8,
//                    resizable: "yes",
//                    close_previous: "no"
//                });
//            }
        };

        tinymce.init(editor_config);

    </script>


@endsection
{{--plugins: [--}}
{{--"advlist autolink lists link image charmap print preview hr anchor pagebreak",--}}
{{--"searchreplace wordcount visualblocks visualchars code fullscreen",--}}
{{--"insertdatetime media nonbreaking save table contextmenu directionality",--}}
{{--"emoticons template paste textcolor colorpicker textpattern"--}}
]