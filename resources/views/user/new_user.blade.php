<button type="button" id="btn_new_user" class="btn btn-success btn-sm" data-toggle="modal"
        data-target="#modal_new_user">New
</button>
<!-- Modal -->
<div id="modal_new_user" class="modal fade " role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frm_new_user" usere="form">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


                    <div class="form-group has-feedback">
                        <div class="col-lg-12 col-sm-12">
                            <input type="text" id="nu_name" class="form-control"
                                   placeholder="{{ trans('adminlte_lang::message.fullname') }}" name="name"
                                   value="{{ old('name') }}"/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <div class="col-lg-12 col-sm-12">
                            <input type="text" id="nu_username" class="form-control" placeholder="Username"
                                   name="username" value="{{ old('username') }}"/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-12 col-sm-12">
                            <input type="email" id="nu_email" class="form-control"
                                   placeholder="{{ trans('adminlte_lang::message.email') }}" name="email"
                                   value="{{ old('email') }}">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <div class="col-sm-12 col-lg-12">
                            <input type="password" id="nu_password" class="form-control"
                                   placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-12 col-lg-12">
                            <input type="password" id="nu_password_confirmation" class="form-control"
                                   placeholder="{{ trans('adminlte_lang::message.retrypepassword') }}"
                                   name="password_confirmation"/>
                            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group has-feedback">

                        <div class="col-xs-1">

                            <label>
                                <div class="checkbox_register checkbox">
                                    <label>
                                        <input type="checkbox" id="nu_active" value='1' name="active">
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
                    <div class="form-group has-feedback">
                        <div class="col-sm-12 col-lg-12">
                            <select multiple="multiple" size="10" id='new_user_rol' name="rol_user[]"></select>
                        </div>
                    </div>


                    <div class="form-group has-feedback">
                        <div class="col-sm-offset-10">
                            <button type="button" id="submit_new_user" class="btn btn-default">Add</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>

    </div>
</div>