@extends('layouts.admin')
@section('title', 'Edit Role')
@section('roles_add', 'active')
@section('content')

    <div class="row row-eq-spacing-lg">
        <div class="col-lg-12">
            <div class="content">
                <h1 class="content-title">Edit Role</h1>
            </div>

            <div class="card col-md-6">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$role->name}}" placeholder="e.g. admin" required>
                    </div>
                    <div class="form-group">
                        <label>Display Name</label>
                        <input type="text" class="form-control" name="display_name" value="{{$role->display_name}}" placeholder="e.g Admin" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{$role->description}}" placeholder="Describe this role">
                    </div>
                    <div class="form-group">
                        <label>Permissions</label><br/>
                        @foreach($permissions as $perm)
                        <div class="custom-checkbox">
                            <input type="checkbox" id="checkbox-{{$perm->id}}" name="permissions[]" value="{{$perm->id}}"
                            @foreach($role->Perms as $p)
                                @if($p->id == $perm->id)
                                checked
                                @endif
                            @endforeach
                            >
                            <label for="checkbox-{{$perm->id}}">{{$perm->display_name}}</label>
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection