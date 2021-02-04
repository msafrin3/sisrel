@extends('layouts.admin')
@section('title', 'Add new meta')
@section('metas_add', 'active')
@section('content')

    <div class="row row-eq-spacing-lg">
        <div class="col-md-12">
            <div class="content">
                <h1 class="content-title">Add New Meta</h1>
            </div>

            <div class="card col-md-6">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label>Display Name</label>
                        <input type="text" class="form-control" name="display_name" value="{{old('display_name')}}" placeholder="Enter Display Name" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection