@extends('layouts.app')
@section('htmlheader_title')
    Role
@endsection


@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles</div>


                    @include('user.new_rol')
                    @include('user.edit_rol')


                    <div class="panel-body">
                        <table class="table table-bordered" id="role-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Display name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>


                        {{ trans('adminlte_lang::message.logged') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('add_scripts')
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{ asset('/js/role.js') }}" type="text/javascript"></script>
@endsection

