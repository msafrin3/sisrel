@extends('layouts.main')
@section('title', 'Daftar Borang Levi')
@section('levi', 'active')
@section('content')

    <section class="content-header">
        <h1>Daftar Borang Levi</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}">Laman Utama</a></li>
            <li class="active">Daftar Borang Levi</li>
        </ul>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Rekod pendaftaran levi</h3>
                <div class="pull-right">
                    <a href="{{ url('levi/add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle fa-fw"></i> Daftar Baru Levi</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Eksais</th>
                            <th>Nama Syarikat</th>
                            <th>Berat (Matrik Tan)</th>
                            <th>Jumlah (RM)</th>
                            <th>Penalti</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        @foreach($levis as $levi)
                        <?php $count++; ?>
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $levi->registration_no }}</td>
                            <td>{{ $levi->Pelesen->company_name }}</td>
                            <td>{{ number_format($levi->weight, 2) }}</td>
                            <td>{{ number_format($levi->total_payment, 2) }}</td>
                            <td>{{ number_format($levi->penalty, 2) }}</td>
                            <td>
                                @if($levi->status == 'BARU')
                                <label class="label label-primary">{{ $levi->status }}</label>
                                @elseif($levi->status == 'DISAHKAN')
                                <label class="label label-warning">{{ $levi->status }}</label>
                                @elseif($levi->status == 'DIBAYAR')
                                <label class="label label-success">{{ $levi->status }}</label>
                                @endif
                            </td>
                            <td style="text-align:center;white-space:nowrap">
                                <a href="{{ url('levi/show/'.$levi->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                                @role('officer')
                                <a href="{{ url('levi/edit/'.$levi->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                @endrole
                                @role('confirm_officer')
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalConfirmation" onclick="getLevi('{{ $levi->id }}')"><i class="fa fa-thumbs-up" data-toggle="tooltip" title="Pengesahan Levi"></i></button>
                                @endrole
                                @role('payment_officer')
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalPayment" onclick="getLevi('{{ $levi->id }}')"><i class="fa fa-money" data-toggle="tooltip" title="Pengesahan Bayaran"></i></button>
                                @endrole
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- confirmation -->
    <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Pengesahan Maklumat Levi</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-levi">
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-confirm">Sahkan Maklumat</button>
                </div>
            </div>
        </div>
    </div>

    <!-- payment -->
    <div class="modal fade" id="modalPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Pengesahan Terima Bayaran</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-levi">
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-confirm">Sahkan Terima Bayaran</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footerScripts')

    <script>
    
        function getLevi(levi_id) {
            $("#modalConfirm").find(".btn-confirm").attr('onclick', "confirmation(" + levi_id + ")");
            $("#modalPayment").find(".btn-confirm").attr('onclick', "payment(" + levi_id + ")");
            $.ajax({
                url: "{{ url('levi/getLevi') }}",
                type: "GET",
                data: "id=" + levi_id,
                success: function(response) {
                    console.log(response);
                    var tbody = '<tr>'+
                        '<th>No. Daftar / Eksais</th>'+
                        '<td>' + response.registration_no + '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th>Nama Syarikat</th>'+
                        '<td>' + response.pelesen.company_name + '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th>Tarikh terima</th>'+
                        '<td>' + response.date + '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th>Berat (Matrik Tan)</th>'+
                        '<td style="text-align:right">' + response.weight.toLocaleString() + '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th>Jumlah yang perlu dibayar (RM)</th>'+
                        '<td style="text-align:right">' + response.total_payment.toLocaleString() + '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th>Penalti (RM)</th>'+
                        '<td style="text-align:right">' + response.penalty.toLocaleString() + '</td>'+
                    '</tr>'

                    $(".table-levi").find('tbody').html(tbody);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        function confirmation(id) {
            var r = confirm("Adakah anda pasti dengan maklumat yang dikemukakan?");
            if(r) {
                $.ajax({
                    url: "{{ url('levi/updateConfirmation') }}",
                    type: "POST",
                    data: "_token={{csrf_token()}}&levi_id=" + id,
                    success: function(response) {
                        console.log(response);
                        if(response.status == 'success') {
                            $("#modalConfirm").modal('toggle');
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            $("#modalConfirm").modal('toggle');
                            toastr.error(response.message);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        }

        function payment(id) {
            var r = confirm("Adakah anda pasti dengan maklumat yang dikemukakan?");
            if(r) {
                $.ajax({
                    url: "{{ url('levi/updatePayment') }}",
                    type: "POST",
                    data: "_token={{csrf_token()}}&levi_id=" + id,
                    success: function(response) {
                        console.log(response);
                        if(response.status == 'success') {
                            $("#modalPayment").modal('toggle');
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            $("#modalPayment").modal('toggle');
                            toastr.error(response.message);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        }
    
    </script>

@endsection