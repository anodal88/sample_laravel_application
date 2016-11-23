<button type="button" id="addrol" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_new_rol">New </button>
<!-- Modal -->
<div id="modal_new_rol" class="modal fade " role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Role</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frm_new_rol" role="form">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="form-group has-feedback">
                        <div class="col-lg-12 col-sm-12">
                            <input type="text" class="form-control" id="nr_name"
                                   placeholder="Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-12 col-sm-12">
                            <input type="text" class="form-control" id="nr_display_name"
                                   placeholder="Display Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <div class="col-sm-12 col-lg-12">
                            <textarea class="form-control" rows="3" id="nr_description"
                                      placeholder="Description"></textarea>
                            <span class="glyphicon glyphicon-text-height form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <div class="col-sm-12 col-lg-12">
                            <select multiple="multiple" size="10" id='nr_permission_rol' name="permission_rol[]"></select>
                        </div>
                    </div>



                    <div class="form-group has-feedback">
                        <div class="col-sm-offset-10">
                            <button type="button" id="submit_new_rol" class="btn btn-default">Add</button>
                        </div>
                    </div>
                </form>





            </div>
        </div>

    </div>
</div>