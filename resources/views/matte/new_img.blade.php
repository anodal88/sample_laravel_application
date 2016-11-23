<!-- Modal -->
<div id="modal_def_img" class="modal fade " role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Image</h4>
            </div>
            <div class="modal-body">


                <div class=" text-center btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <label>
                            <input type="radio" name="inlineRadioOptions" id="img_horizontal" value="horizontal">
                            Horizontal
                        </label>
                    </div>
                    <div class="btn-group" role="group">
                        <label>
                            <input type="radio" name="inlineRadioOptions" id="img_vertical" value="vertical"> Vertical
                        </label>
                    </div>
                </div>

                </br>
                <label for="height">Height</label>

                <div class="input-group">

                    <input required type="text" id="height" class="form-control" aria-label="Height"
                           aria-describedby="sizing-addon3"
                           placeholder="Height">
                    <span class="input-group-addon">in</span>


                </div>
                </br>
                <label for="height"> Width</label>
                <div class="input-group">

                    <input required type="text" class="form-control" id="width" aria-label="Width"
                           aria-describedby="sizing-addon3"
                           placeholder="Width">
                    <span class="input-group-addon">in</span>
                </div>

                </br>
                <div class="form-group">
                    <label for="select row">Select Row:</label>
                    <select class="form-control" id="select_row">
                        {{--<option>1</option>--}}
                        {{--<option>2</option>--}}
                        {{--<option>3</option>--}}
                        {{--<option>4</option>--}}
                    </select>

                </div>

                <div class="form-group">
                    <label for="select column">Select Column:</label>
                    <select class="form-control" id="select_column">
                        {{--<option>1</option>--}}
                        {{--<option>2</option>--}}
                        {{--<option>3</option>--}}
                        {{--<option>4</option>--}}
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btn_def_img" class="btn btn-primary">Create</button>
            </div>

        </div>

    </div>
</div>