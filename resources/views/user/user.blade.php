@extends('layouts.app')
@section('htmlheader_title')
    User
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    @include('user.new_user')
                    @include('user.edit_user')
                    @include('user.reset_password')

                    <div class="panel-body">
                        <table class="table table-bordered" id="user-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
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
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <script src="{{ asset('/js/user.js') }}" type="text/javascript"></script>
@endsection