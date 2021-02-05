@extends('layouts.admin')
@section('title', 'Users')
@section('users_list', 'active')
@section('content')

    <div class="row row-eq-spacing-lg">
        <div class="col-md-12">
            <div class="content">
                <h1 class="content-title">Users</h1>
            </div>
            <div class="card">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Permissions</th>
                            <th>Registered At</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        @foreach($users as $user)
                        <?php $count++; ?>
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach($user->roles as $role)
                                <span class="badge badge-primary">{{$role->display_name}}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($user->permissions as $permission)
                                <span class="badge badge-info">{{$permission->display_name}}</span>
                                @endforeach
                            </td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                @if($user->deleted_at != null)
                                <span class="badge badge-danger">DISABLED</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{url('admin/users/'.$user->id)}}" class="btn btn-default btn-sm" data-toggle="tooltip" data-title="Edit User">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @if($user->deleted_at == null)
                                <a href="javascript:;" class="btn btn-info btn-sm" onclick="deleteUser('{{$user->id}}', 0, 0)" data-toggle="tooltip" data-title="Disable User">
                                    <i class="fa fa-ban"></i>
                                </a>
                                @elseif($user->deleted_at != null)
                                <a href="javascript:;" class="btn btn-default btn-sm" onclick="deleteUser('{{$user->id}}', 0, 1)" data-toggle="tooltip" data-title="Enable User">
                                    <i class="fa fa-check"></i>
                                </a>
                                @endif
                                <a href="javascript:;" class="btn btn-danger btn-sm" onclick="deleteUser('{{$user->id}}', 1, 0)" data-toggle="tooltip" data-title="Permanent Delete User">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{url('admin/users/add')}}" class="btn btn-primary"><i class="fa fa-user-plus fa-fw"></i> Add New User</a>
        </div>
    </div>

@endsection

@section('footerScripts')

    <script>
        function deleteUser(user_id, is_permanent, is_enable) {
            var title = (is_enable == 0 ? 'Delete Confirmation' : 'Restore User');
            var content = (is_enable == 0 ? 'Are you sure want to delete this user?' : 'Are you sure want to restore this user?');
            var color = (is_enable == 0 ? 'red' : 'blue');
            var btnText = (is_enable == 0 ? 'DELETE' : 'RESTORE');

            var r = confirm(content);
            if(r) {
                $.ajax({
                    url: "{{url('')}}/admin/users/"+user_id+"/delete",
                    type: "POST",
                    data: "_token={{csrf_token()}}&user_id="+user_id+"&is_permanent="+is_permanent+"&is_enable="+is_enable,
                    success: function(response) {
                        if(response.status == 'success') {
                            halfmoon.initStickyAlert({
                                content: response.message,
                                title: "Hooray",
                                alertType: "alert-success"
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                    },
                    error: function(response) {
                        halfmoon.initStickyAlert({
                            content: response.message,
                            title: "Opps",
                            alertType: "alert-danger",
                            timeShown: 10000
                        });
                    }
                });
            }
        }
    </script>

@endsection