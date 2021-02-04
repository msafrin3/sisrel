@extends('layouts.admin')
@section('title', 'Role Management')
@section('roles_list', 'active')
@section('content')

    <div class="row row-eq-spacing-lg">
        <div class="col-lg-12">
            <div class="content">
                <h1 class="content-title">Role Management</h1>
            </div>
            <div class="card">
                <h2 class="card-title">List Role</h2>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Permissions</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        @foreach($roles as $role)
                        <?php $count++; ?>
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->display_name}}</td>
                            <td>{{$role->description}}</td>
                            <td>{{$role->created_at}}</td>
                            <td>
                                @foreach($role->permissions as $perm)
                                <span class="badge badge-success">{{$perm->display_name}}</span>
                                @endforeach
                            </td>
                            <td style="text-align:center">
                                <a href="{{url('admin/roles/'.$role->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{url('admin/roles/add')}}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw"></i> Add New Role</a>
        </div>
    </div>

@endsection