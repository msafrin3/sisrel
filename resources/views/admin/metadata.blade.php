@extends('layouts.admin')
@section('title', 'Meta Data')
@section('metadata_list', 'active')
@section('content')

    <div class="row row-eq-spacing-lg">
        <div class="col-md-12">
            <div class="content">
                <h1 class="content-title">List Meta Data</h1>
            </div>
            <div class="card">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Meta</th>
                            <th>Value</th>
                            <th>Group Helper</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        @foreach($metadatas as $metadata)
                        <?php $count++; ?>
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$metadata->Meta->display_name}}</td>
                            <td>{{$metadata->value}}</td>
                            <td>{{$metadata->group_helper}}</td>
                            <td style="text-align:center">
                                <a href="{{url('admin/metadata/'.$metadata->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteMetadata('{{$metadata->id}}')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{url('admin/metadata/add')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Meta Data</a>
        </div>
    </div>

@endsection

@section('footerScripts')

    <script>
    
        function deleteMetadata(metadata_id) {
            var r = confirm('Are you sure want to delete this data?');
            if(r) {
                $.ajax({
                    url: "{{url('')}}/admin/metadata/" + metadata_id + "/delete",
                    type: "POST",
                    data: "_token={{csrf_token()}}&metadata_id=" + metadata_id,
                    success: function(response) {
                        if(response.status == 'success') {
                            halfmoon.initStickyAlert({
                                content: response.message,
                                title: "Hooray",
                                alertType: "alert-success"
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(err) {
                        halfmoon.initStickyAlert({
                            content: err.message,
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