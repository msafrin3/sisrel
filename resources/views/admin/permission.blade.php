@extends('layouts.admin')
@section('title', 'Permission Management')
@section('permissions_list', 'active')
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
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        @foreach($permissions as $perm)
                        <?php $count++; ?>
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$perm->name}}</td>
                            <td>{{$perm->display_name}}</td>
                            <td>{{$perm->description}}</td>
                            <td>{{$perm->created_at}}</td>
                            <td style="text-align:center">
                                <a href="{{url('admin/permissions/'.$perm->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deletePermission('{{$perm->id}}')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{url('admin/permissions/add')}}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw"></i> Add New Role</a>
        </div>
    </div>

@endsection

@section('footerScripts')

    <script>
        
        function deletePermission(permission_id) {
            var r = confirm('Are you sure want to delete this permission?');
            if(r) {
                $.ajax({
                    url: "{{url('')}}/admin/permissions/" + permission_id + "/delete",
                    type: "POST",
                    data: "_token={{csrf_token()}}&permission_id=" + permission_id,
                    success: function(response) {
                        if(response.status == 'success') {
                            halfmoon.initStickyAlert({
                                content: response.message,
                                title: "Bravo!",
                                alertType: "alert-success"
                            });
                        } else {
                            halfmoon.initStickyAlert({
                                content: response.message,
                                title: "Opps",
                                alertType: "alert-danger",
                                timeShown: 10000
                            });
                        }
                    },
                    error: function(err) {
                        halfmoon.initStickyAlert({
                            content: err.message,
                            title: "Error",
                            alertType: "alert-danger",
                            timeShown: 10000
                        });
                    }
                });
            }
        }

    </script>

@endsection