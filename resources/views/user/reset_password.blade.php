<!-- Modal -->
<div id="modal_reset_password" class="modal fade " usere="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reset Password</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frm_reset_password" usere="form">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="rp_id" value="0">


                       <div class="form-group has-feedback">
                        <div class="col-sm-12 col-lg-12">
                            <input type="password" id="rp_password" class="form-control"
                                   placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-12 col-lg-12">
                            <input type="password" id="rp_password_confirmation" class="form-control"
                                   placeholder="{{ trans('adminlte_lang::message.retrypepassword') }}"
                                   name="password_confirmation"/>
                            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <div class="col-sm-offset-10">
                            <button type="button" id="submit_reset_password" class="btn btn-default">Add</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>

    </div>
</div>