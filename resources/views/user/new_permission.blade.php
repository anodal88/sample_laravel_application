<button type="button" class="btn btn-success btn-sm"  id="btn_new_permission" data-toggle="modal"
        data-target="#modal_new_permssion">New
</button>
<!-- Modal -->
<div id="modal_new_permssion" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Role</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                   <div class="form-group has-feedback">
                        <div class="col-lg-12 col-sm-12">
                            <input type="text" class="form-control" id="np_name"
                                   placeholder="Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>

                        </div>
                    </div>
                   <div class="form-group has-feedback">
                        <div class="col-sm-12 col-sm-12">
                            <input type="text" class="form-control" id="np_display_name"
                                   placeholder="Display Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                    </div>

                   <div class="form-group has-feedback">
                        <div class="col-sm-12 col-lg-12">
                            <textarea class="form-control" rows="3" id="np_description"
                                      placeholder="Description"></textarea>
                            <span class="glyphicon glyphicon-text-height form-control-feedback"></span>

                        </div>
                    </div>
                   <div class="form-group has-feedback">
                        <div class="col-sm-offset-10">
                            <button type="submit" id="submit_np" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>