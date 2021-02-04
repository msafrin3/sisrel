@extends('layouts.admin')
@section('title', 'Edit Permission')
@section('permissions_add', 'active')
@section('content')

    <div class="row row-eq-spacing-lg">
        <div class="col-lg-12">
            <div class="content">
                <h1 class="content-title">Edit Permission</h1>
            </div>

            <div class="card col-md-6">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$permission->name}}" placeholder="e.g. admin" required>
                    </div>
                    <div class="form-group">
                        <label>Display Name</label>
                        <input type="text" class="form-control" name="display_name" value="{{$permission->display_name}}" placeholder="e.g Admin" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{$permission->description}}" placeholder="Describe this role">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection