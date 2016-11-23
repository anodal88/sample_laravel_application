<!-- Modal -->
<div id="modal_def_mette" class="modal fade " role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Mette</h4>
            </div>
            <div class="modal-body">
                {{--<label class="radio-inline">--}}
                {{--<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="vertical"> Vertical--}}
                {{--</label>--}}
                {{--<label class="radio-inline">--}}
                {{--<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="horizontal"> Horizontal--}}
                {{--</label>--}}

                <div class=" text-center btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <label>
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="horizontal">
                            Horizontal
                        </label>
                    </div>
                    <div class="btn-group" role="group">
                        <label>
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="vertical"> Vertical
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
                <label for="height"> Rows and Columns</label>
                <div class="input-group">

                    <input required type="text" class="form-control" id="rows" aria-label="Rows"
                           aria-describedby="sizing-addon3"
                           placeholder="Rows">

                    <input required type="text" class="form-control" id="columns" aria-label="Columns"
                           aria-describedby="sizing-addon3"
                           placeholder="Columns">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btn_def_mette" class="btn btn-primary">Create</button>
            </div>

        </div>

    </div>
</div>