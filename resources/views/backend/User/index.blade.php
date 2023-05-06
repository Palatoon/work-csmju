@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->


<!-- begin row -->
<div class="row">
    <!-- begin col-10 -->
    <div class="col-xl-12">
        <!-- begin panel -->
        <div class="panel">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title"><i class="fa fa-user mr-2"></i>User</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <table class="table table-striped table-bordered table-td-valign-middle datatable">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Name</th>
                            <!-- <th class="text-nowrap">Username</th> -->
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Role</th>
                            <th class="text-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <!-- <td>{{ $item->username }}</td> -->
                            <td>{{ $item->email }}</td>
                            <td>
                                @switch($item->roles()->first()->name)
                                @case('Super Admin')
                                <span class="label label-indigo">{{$item->roles()->first()->name}}</span>
                                @break
                                @case('Admin')
                                <span class="label label-pink">{{$item->roles()->first()->name}}</span>
                                @break
                                @case('Normal User')
                                <span class="label label-inverse">{{$item->roles()->first()->name}}</span>
                                @break
                                @default
                                @endswitch
                            <td>
                                @if(\Session::get('username') != $item->username)
                                <div class="btn-group ml-1">
                                    <a href="javascript:;" class="btn btn-sm btn-info">Change Role</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-sm btn-info dropdown-toggle" aria-expanded="false"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @if($item->roles()->first()->name != 'Super Admin')<a href="javascript:;" class="dropdown-item chaneg-user-role" data-token="{{ Session::token() }}" data-id="{{$item->id}}" data-slug="super-admin">Super Admin</a>@endif
                                        @if($item->roles()->first()->name != 'Admin')<a href="javascript:;" class="dropdown-item chaneg-user-role" data-token="{{ Session::token() }}" data-id="{{$item->id}}" data-slug="admin">Admin</a>@endif
                                        @if($item->roles()->first()->name != 'Normal User')<a href="javascript:;" class="dropdown-item chaneg-user-role" data-token="{{ Session::token() }}" data-id="{{$item->id}}" data-slug="user">Normal User</a>@endif
                                    </div>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-10 -->
</div>
<!-- end row -->
@endsection