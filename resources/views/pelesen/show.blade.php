@extends('layouts.main')
@section('title', $pelesen->company_name)
@section('pelesen', 'active')
@section('headerScripts')

    <link rel="stylesheet" href="{{ url('') }}/plugins/ba3js/ba3.css">

@endsection
@section('content')

    <style>
        @media print {
            .print-content, footer {
                display: none;
            }
        }
    </style>

    <section class="content-header">
        <h1>Maklumat Pelesen / Syarikat</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}">Laman Utama</a></li>
            <li><a href="{{ url('pelesen') }}">Pelesen</a></li>
            <li class="active">{{ $pelesen->company_name }}</li>
        </ul>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user fa-fw"></i> Maklumat Pelesen</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nama Syarikat / Pelesen</th>
                            <td>{{ $pelesen->company_name }}</td>
                        </tr>
                        <tr>
                            <th>No. Lesen</th>
                            <td>{{ $pelesen->license_no }}</td>
                        </tr>
                        <tr>
                            <th>No. File</th>
                            <td>{{ $pelesen->file_no }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pengurus / Akauntan</th>
                            <td>{{ $pelesen->accountant_name }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $pelesen->address }}</td>
                        </tr>
                        <tr>
                            <th>No. Telefon</th>
                            <td>{{ $pelesen->contact_no }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $pelesen->email }}</td>
                        </tr>
                        <tr>
                            <th>Keluasan Hektar Ladang</th>
                            <td>{{ $pelesen->area }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Lampiran:</th>
                        </tr>
                        @foreach($pelesen->Attachments as $attachment)
                        <tr>
                            <th>{{ $attachment->title }}</th>
                            <td><a href="{{ url('') }}/storage/attachment/{{ $attachment->file_name }}" target="_blank">{{ $attachment->file_name }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-money fa-fw"></i> Rekod pembayaran levi</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Daftar</th>
                            <th>Tarikh Pembayaran</th>
                            <th>Berat (Matrik tan)</th>
                            <th>Jumlah bayaran (RM)</th>
                            <th>Penalti (RM)</th>
                            <th>No. Resit</th>
                            <th>Status</th>
                            <th>Disahkan Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        @foreach($pelesen->Levis()->orderBy('date')->get() as $levi)
                        <?php $count++; ?>
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $levi->registration_no }}</td>
                            <td>{{ date('d M Y', strtotime($levi->date)) }}</td>
                            <td>{{ number_format($levi->weight, 2) }}</td>
                            <td>{{ number_format($levi->total_payment, 2) }}</td>
                            <td>{{ number_format($levi->penalty, 2) }}</td>
                            <td>{{ $levi->resit_no }}</td>
                            <td>
                                @if($levi->status == 'BARU')
                                <label class="label label-primary">{{ $levi->status }}</label>
                                @elseif($levi->status == 'DISAHKAN')
                                <label class="label label-warning">{{ $levi->status }}</label>
                                @elseif($levi->status == 'DIBAYAR')
                                <label class="label label-success">{{ $levi->status }}</label>
                                @endif
                            </td>
                            <td>
                                @if($levi->confirm_by != null || $levi->confirm_by != '')
                                {{ $levi->Confirm->name }} <br/> <i><b>Tarikh Disahkan:</b> {{ date('d M Y', strtotime($levi->confirm_at)) }}</i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-line-chart fa-fw"></i> Laporan Bulanan & Tahunan</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="monthly"></div>
                    </div>
                    <div class="col-md-12">
                        <div id="yearly"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="print-content" style="margin-top: 20px;text-align:center">
            <button type="button" class="btn btn-default" onclick="window.print()"><i class="fa fa-print fa-fw"></i> Print</button>
        </div>
    </section>

@endsection

@section('footerScripts')

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        $(document).ready(function() {
            getReport();
        });

        function getReport() {
            $.ajax({
                url: "{{ url('pelesen/getReport') }}",
                type: "GET",
                data: "pelesen_id={{ $pelesen->id }}",
                success: function(response) {
                    console.log(response);

                    var monthly_category = [];
                    var monthly_data_weight = [];
                    var monthly_data_payment = [];
                    var monthly_data_penalty = [];
                    
                    $.each(response.monthly, function(index,value) {
                        monthly_category.push(value.month_name + ' ' + value.year_short);
                        monthly_data_weight.push(parseFloat(value.total_weight));
                        monthly_data_payment.push(parseFloat(value.total_payment));
                        monthly_data_penalty.push(parseFloat(value.total_penalty));
                    });

                    Highcharts.chart('monthly', {
                        credits: {
                            enabled: false
                        },
                        exporting: {
                            enabled: false
                        },
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Laporan Bulanan'
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: monthly_category,
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Rainfall (mm)'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'Weight (MT)',
                            data: monthly_data_weight

                        }, {
                            name: 'Payment (RM)',
                            data: monthly_data_payment,
                            color: 'green'

                        }, {
                            name: 'Penalty (RM)',
                            data: monthly_data_penalty,
                            color: 'red'
                        }]
                    });

                    // yearly ========
                    var yearly_category = [];
                    var yearly_data_weight = [];
                    var yearly_data_payment = [];
                    var yearly_data_penalty = [];
                    
                    $.each(response.yearly, function(index,value) {
                        yearly_category.push(value.year_date);
                        yearly_data_weight.push(parseFloat(value.total_weight));
                        yearly_data_payment.push(parseFloat(value.total_payment));
                        yearly_data_penalty.push(parseFloat(value.total_penalty));
                    });

                    Highcharts.chart('yearly', {
                        credits: {
                            enabled: false
                        },
                        exporting: {
                            enabled: false
                        },
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Laporan Tahunan'
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: yearly_category,
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Rainfall (mm)'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'Weight (MT)',
                            data: yearly_data_weight

                        }, {
                            name: 'Payment (RM)',
                            data: yearly_data_payment,
                            color: 'green'

                        }, {
                            name: 'Penalty (RM)',
                            data: yearly_data_penalty,
                            color: 'red'
                        }]
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    </script>

@endsection