/**
 * Created by Adrian Lara on 10/24/16.
 */



$(function () {
    init();

    $('#btn_def_mette').on('click', function () {
        $('#matte_prop').empty();

        var verticalidad = $('div#modal_def_mette input#inlineRadio1').val();
        var height = $('div#modal_def_mette input#height').val();
        var width = $('div#modal_def_mette input#width').val();

        var rows = $('div#modal_def_mette input#rows').val();
        var columns = $('div#modal_def_mette input#columns').val();

        render_mette(verticalidad, height, width, rows, columns);

        $('#modal_def_mette').modal('hide');
    });


    css = []
    $(".drag").draggable({
        stop: function (event, ui) {
            val_letf = conv($(event.target).css('left'), true, false);
            val_top = conv($(event.target).css('top'), true, false);
            $('input#left').val(val_letf);
            $('input#top').val(val_top);
        }
    }).resizable();

    $(".drag2").draggable({
        stop: function (event, ui) {
            val_letf = conv($(event.target).css('left'), true, false);
            val_top = conv($(event.target).css('top'), true, false);
            $('input#left').val(val_letf);
            $('input#top').val(val_top);
        }
    }).resizable();

    $("#text-p").draggable({
        stop: function (event, ui) {
            val_letf = conv($(event.target).css('left'), true, false);
            val_top = conv($(event.target).css('top'), true, false);
            $('input#left').val(val_letf);
            $('input#top').val(val_top);
        }
    }).resizable();


    $('#matte div#matte_prop').click(function (e) {
        // console.log(e.target);
        // console.log(e.currentTarget);

        var elemnt = $(e.target);
        elemnt.keyup(function () {
            if (this.value != "") {
                // console.log(elemnt.data('own_id'));
                // console.log(elemnt);
                px = add_ext(convert_in_to_px(del_ext(this.value, true)), "px");
                elemnt.data('own_id').css(elemnt.attr('id'), px);
            }


        });
    });

    $('#matte div#matte-container').click(function (e) {
        $('#matte_prop').empty();
        var elemnt = e.target; // este es el elemento en el que se hizo click
        var father = e.currentTarget; // este es #padre
        if (elemnt != father) {
            paint_prop($(elemnt).getStyleObject(), $(elemnt));
        }


        // console.log($(elemnt).css('top'))
    });
});

/*
 Delete Extension is True delete px , is false delete in
 */
function del_ext(cad, px) {
    var tmp = 0;
    if (px) {
        tmp = cad.split('px')[0];
    } else {
        tmp = cad.split('in')[0];
    }
    if (isNaN(tmp)) {
        return cad
    }
    return tmp
}

function convert_in_to_px(num) {
    if (isNaN(num)) {
        return num
    }

    return (num * 96).toFixed(2)
}

function convert_px_to_in(num) {

    if (isNaN(num)) {
        return num
    }

    return (num / 96).toFixed(2)
}

function add_ext(num, ext) {

    if (isNaN(num)) {
        return num
    }

    return num + ext;
}


function paint_prop(obj, parent) {
    var tmp = "";
    var div = 0;
    var container = $('<div>');
    var li = $('<li>');
    $.each(obj, function (index, value) {
        // console.log(index + ": " + value);

        var split = index.split("-")[0];
        if (split != tmp) {
            var gruop = $('<div>').attr({
                class: 'accordion-group ' + index
            });


            var tooggle = $('<a>').attr({
                class: 'accordion-toggle'
            }).data('toggle', 'collapse').data('parent', 'div');
            tooggle.text(split);

            var head = $('<div>').attr({
                class: 'accordion-heading'
            });

            tooggle.appendTo(head);
            head.appendTo(gruop);


            var body = $('<div>').attr({
                class: 'accordion-body in collapse',
                id: index
            });

            var inner = $('<div>').attr({
                class: 'accordion-inner'
            });

            inner.appendTo(body);

            var list = $('<ul>').attr({
                class: 'property-list'
            });

            list.appendTo(inner);
            body.appendTo(gruop);

            gruop.appendTo($('#matte_prop'));
            tmp = split;
            li = $('<li>');
            div = 0;

        }
        li.attr({
            id: 'prop-index-' + div
        });

        //  console.log(parent.attr('id'));
        $('<span>').text(index).appendTo(li);
        $('<input>').attr({
            id: index,
            type: 'text',
            value: value,
            'data-own_id': parent,
        }).data('own_id', parent).appendTo($('<div>')).appendTo(li);

        li.appendTo(list);
        div += 1;


    });
}

$.fn.getStyleObject = function () {
    var dom = this.get(0);
    var style;
    var resp = {};
    var my_prop = ['margin-bottom', 'margin-left', 'margin-right', 'margin-top', 'rowspan', 'colspan', 'height', 'width', 'rows', 'columns', 'left', 'top']
    if (window.getComputedStyle) {
        // var camelize = function (a, b) {
        //     return b.toUpperCase();
        // };
        style = window.getComputedStyle(dom, null);
        for (var i = 0; i < style.length; i++) {
            var prop = style[i];
            // var camel = prop.replace(/\-([a-z])/g, camelize);
            var val = style.getPropertyValue(prop);
            // console.log(prop);
            if ($.inArray(prop, my_prop) != -1) {

                resp[prop] = add_ext(convert_px_to_in(del_ext(val, true)), "in");
                // resp[prop] = conv(val, true, false);
            }
        }
        return resp;
    }
    if (dom.currentStyle) {
        style = dom.currentStyle;
        for (var prop in style) {
            if ($.inArray(prop, my_prop) != -1) {
                resp[prop] = add_ext(convert_px_to_in(del_ext(style[prop], true)), "in");
            }
        }
        return resp;
    }

    return this.css();
}

function init() {
    if ($('#div_table_resposive_matte').length) {
        $('div#new_mette').hide()
        $('div#new_img').show()
    } else {
        $('div#new_mette').show()
        $('div#new_img').hide()
    }

}

/*
 Function render Mette
 */

function render_mette(verticalidad, height, width, rows, columns) {
    var my_height = height;
    var my_width = width;
    if (verticalidad == 'horizontal') {
        my_height = width;
        my_width = height;
    }


    var div_table_resposive_matte = $("<div>").attr({
        id: 'div_table_resposive_matte',
        class: 'table-responsive'
    });

    var table_resposive_matte = $("<table>").attr({
        id: 'table_resposive_matte',
        class: 'table'
    });


    // var prop_height = add_ext(proportion(convert_in_to_px(my_height), convert_in_to_px(my_height), del_ext($('div#matte-container').css('height'), true)), "px");
    // var prop_width = add_ext(proportion(convert_in_to_px(my_width), convert_in_to_px(my_width), del_ext($('div#matte-container').css('width'), true)), "px");

    // div_table_resposive_matte.css("height", prop_height);
    // div_table_resposive_matte.css("width", prop_width);

    var select_column = $('div#modal_def_img select#select_column');
    var select_row = $('div#modal_def_img select#select_row');
    var count = 1;
    for (var i = 0; i < rows; i++) {
        var row = $('<tr>').attr(
            {
                id: 'row_' + i
            });
        for (var j = 0; j < columns; j++) {

            $('<td>').attr({
                id: 'row_' + i + '_column_' + j
            }).css("border", "red solid 1px").text('col:' + (j + 1) + " row:" + (i + 1)).appendTo(row);

            $('<option>').attr({
                value: 'row_' + i + '_column_' + j,
            }).text('Column ' + count).appendTo(select_column);
            count++;
        }

        $('<option>').attr({
            value: 'row_' + i,
        }).text('Row ' + (i + 1)).appendTo(select_row);

        row.appendTo(table_resposive_matte);

    }

    table_resposive_matte.appendTo(div_table_resposive_matte);
    div_table_resposive_matte.appendTo($('div#matte-container'));
    init();

}

function proportion(Vr, Vrc, V) {
    return (Vrc / Vr) * V
}