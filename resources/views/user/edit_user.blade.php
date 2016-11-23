<div id="modal_edit_user" class="modal fade " role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frm_edit_user" role="form">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="eu_id" id="eu_id" value="0">
                    <div class="form-group">
                        <div class="col-lg-12 col-sm-12">
                            <input type="text" class="form-control" id="eu_name"
                                   placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-12">
                            <input type="text" class="form-control" id="eu_username"
                                   placeholder="username">
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                    {{--<div class="col-sm-12 col-sm-12">--}}
                    {{--<input type="email" class="form-control" id="eu_email" placeholder="example@example.com">--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group has-feedback">

                        <div class="col-xs-1">

                            <label>
                                <div class="checkbox_register checkbox">
                                    <label>
                                        <input type="checkbox" id="eu_active" value='1' name="active">
                                    </label>
                                </div>
                            </label>
                        </div>
                        <div class="col-xs-1">
                            <label>
                                <h5>Active</h5>
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-12 col-lg-12">
                            <select multiple="multiple" size="10" id='edit_user_rol' name="edit_user_rol[]"></select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-10">
                            <button type="button" id="submit_edit_user" class="btn btn-default">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>