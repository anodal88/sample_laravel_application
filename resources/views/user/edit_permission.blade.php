<div id="modal_edit_permission" class="modal fade " role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Permission</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frm_edit_permission" role="form">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="ep_id" id="ep_id" value="0">
                    <div class="form-group has-feedback">
                        <div class="col-lg-12 col-sm-12">
                            <input type="text" class="form-control" id="ep_name"
                                   placeholder="Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-12 col-sm-12">
                            <input type="text" class="form-control" id="ep_display_name"
                                   placeholder="Display Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <div class="col-sm-12 col-lg-12">
                            <textarea class="form-control" rows="3" id="ep_description"
                                      placeholder="Description"></textarea>
                            <span class="glyphicon glyphicon-text-height form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <div class="col-sm-offset-10">
                            <button type="button" id="submit_edit_permission" class="btn btn-default">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>