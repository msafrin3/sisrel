@extends('layouts.admin')
@section('title', 'Edit meta data')
@section('metadata_add', 'active')
@section('content')

    <div class="row row-eq-spacing-lg">
        <div class="col-md-12">
            <div class="content">
                <h1 class="content-title">Add New Meta Data</h1>
            </div>

            <div class="card col-md-6">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Meta</label>
                        <select name="meta_id" class="form-control">
                            <option value="" selected="selected" disabled="disabled">Select Meta</option>
                            @foreach($metas as $meta)
                            <option value="{{$meta->id}}">{{$meta->name}} ({{$meta->display_name}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Value</label>
                        <input type="text" class="form-control" name="value" value="{{$metadata->value}}" placeholder="Enter Value" required>
                    </div>
                    <div class="form-group">
                        <label>Group Helper</label>
                        <input type="text" class="form-control" name="group_helper" value="{{$metadata->group_helper}}" placeholder="Enter Group helper">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('footerScripts')

    <script>
        $(document).ready(function() {
            $("select[name=meta_id]").val("{{$metadata->meta_id}}");
        });
    </script>

@endsection