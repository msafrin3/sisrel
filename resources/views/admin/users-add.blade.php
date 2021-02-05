@extends('layouts.admin')
@section('title', 'Add User')
@section('users_add', 'active')
@section('content')

    <div class="row row-eq-spacing-lg">
        <div class="col-md-6">
            <div class="content">
                <h1 class="content-title">Add New User</h1>
            </div>

            <div class="card">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="example@mail.com" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="****" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <label>Roles</label><br/>
                        @foreach($roles as $role)
                        <div class="custom-checkbox">
                            <input type="checkbox" id="role-{{$role->id}}" name="roles[]" value="{{$role->id}}">
                            <label for="role-{{$role->id}}">{{$role->display_name}}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Permissions</label><br/>
                        @foreach($permissions as $perm)
                        <div class="custom-checkbox">
                            <input type="checkbox" id="permission-{{$perm->id}}" name="permissions[]" value="{{$perm->id}}">
                            <label for="permission-{{$perm->id}}">{{$perm->display_name}}</label>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection