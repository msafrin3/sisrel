@extends('layouts.admin')
@section('title', 'Meta')
@section('metas_list', 'active')
@section('content')

    <div class="row row-eq-spacing-lg">
        <div class="col-md-12">
            <div class="content">
                <h1 class="content-title">List Meta</h1>
            </div>
            <div class="card">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        @foreach($metas as $meta)
                        <?php $count++; ?>
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$meta->name}}</td>
                            <td>{{$meta->display_name}}</td>
                            <td style="text-align:center">
                                <a href="{{url('admin/meta/'.$meta->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteMeta('{{$meta->id}}')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{url('admin/meta/add')}}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw"></i> Add New Meta</a>
        </div>
    </div>

@endsection

@section('footerScripts')

    <script>
    
        function deleteMeta(meta_id) {
            var r = confirm('Are you sure want to delete this meta? All the meta data will also be deleted.');
            if(r) {
                $.ajax({
                    url: "{{url('')}}/admin/meta/" + meta_id + "/delete",
                    type: "POST",
                    data: "_token={{csrf_token()}}&meta_id=" + meta_id,
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