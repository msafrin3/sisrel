@extends('layouts.main')
@section('title', 'Maklumat daftar levi')
@section('levi', 'active')
@section('content')

    <style>
        @media print {
            .print-content, footer {
                display: none;
            }
        }
    </style>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Maklumat Levi</h3>
                <div class="pull-right print-content">
                    <a href="{{ url('levi') }}" class="btn btn-default btn-sm"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    <button type="button" class="btn btn-default btn-sm" onclick="window.print();"><i class="fa fa-print fa-fw"></i> Cetak</button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>No. Daftar / Eksais</th>
                                    <td>{{ $levi->registration_no }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Syarikat</th>
                                    <td>{{ $levi->Pelesen->company_name }}</td>
                                </tr>
                                <tr>
                                    <th>Tarikh terima</th>
                                    <td>{{ date('d M Y', strtotime($levi->date)) }}</td>
                                </tr>
                                <tr>
                                    <th>Berat (Matrik Tan)</th>
                                    <td>{{ number_format($levi->weight, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah yang perlu dibayar (RM)</th>
                                    <td>{{ number_format($levi->total_payment, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Penalti (RM)</th>
                                    <td>{{ number_format($levi->penalty, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Pegawai Ditugaskan</th>
                                    <td>{{ $levi->User->name }} <br/><i>{{ $levi->created_at }}</i></td>
                                </tr>
                                <tr>
                                    <th>Disahkan Oleh</th>
                                    <td>
                                        @if($levi->confirm_by != null)
                                        {{ $levi->Confirm->name }} <br/><i>{{ $levi->confirm_at }}</i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bayaran Diterima oleh</th>
                                    <td>
                                        @if($levi->payment_by != null)
                                        {{ $levi->Payment->name }} <br/><i>{{ $levi->payment_at }}</i>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        @if($levi->confirm_by == null)
                        <div style="text-align:right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalConfirm" onclick="getLevi('{{ $levi->id }}')"><i class="fa fa-user fa-fw"></i> Sahkan Maklumat</button></div>
                        @endif
                    </div>
                </div>
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

@endsection

@section('footerScripts')

    <script>
        function getLevi(levi_id) {
            $("#modalConfirm").find(".btn-confirm").attr('onclick', "confirmation(" + levi_id + ")");
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
    </script>

@endsection