@extends('layouts.main')
@section('title', 'Laporan Kewangan')
@section('report', 'active')
@section('content')

    <style>
        @media print {
            footer, button {
                display: none;
            }
        }
    </style>

    <section class="content-header">
        <h1>Laporan Kewangan</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}"><i class="fa fa-home"></i> Laman Utama</a></li>
            <li class="active">Laporan Kewangan</li>
        </ul>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan Bulanan</h3>
            </div>
            <div class="box-body">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label>Pilih Tahun</label>
                            <select name="year" class="form-control">
                                @for($i = date('Y'); $i >= date('Y') - 10; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Pilih Bulan</label>
                            <select name="month" class="form-control"></select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="button" class="btn btn-default" onclick="window.print()"><i class="fa fa-print fa-fw"></i> Cetak</button>
                </form>
            </div>
        </div>

        @if(isset($_GET['year']))
        <div class="box box-default">
            <div class="box-header with-border">
                <?php
                $dateObj   = DateTime::createFromFormat('!m', $_GET['month']);
                $monthName = $dateObj->format('F');
                ?>
                <h3 class="box-title">Laporan Kewangan Levi bagi bulan <b>{{ $monthName.' '.$_GET['year'] }}</b></h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Eksais</th>
                            <th>Nama Syarikat / Pelesen</th>
                            <th>Tarikh Terima</th>
                            <th>Berat Matrik Tan</th>
                            <th>Penalti</th>
                            <th>Jumlah Bayaran</th>
                            <th>Maklumat pegawai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $count = 0;
                        $total_penalty = 0;
                        $total_payment = 0;
                        ?>
                        @foreach($data as $d)
                        <?php
                        $count++;
                        $total_penalty = $total_penalty + $d->penalty;
                        $total_payment = $total_payment + $d->total_payment;
                        ?>
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $d->registration_no }}</td>
                            <td>{{ $d->Pelesen->company_name }}</td>
                            <td>{{ date('d M Y', strtotime($d->date)) }}</td>
                            <td style="text-align:right">{{ number_format($d->weight, 2) }}</td>
                            <td style="text-align:right">{{ number_format($d->penalty, 2) }}</td>
                            <td style="text-align:right">{{ number_format($d->total_payment, 2) }}</td>
                            <td>{{ $d->Payment->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <table class="pull-right" style="margin-top:20px">
                    <tr>
                        <td>JUMLAH HASIL</td>
                        <th>: RM {{ number_format($total_payment, 2) }}</th>
                    </tr>
                </table>
            </div>
        </div>
        @endif
    </section>

@endsection

@section('footerScripts')

    <script>
        $(document).ready(function() {
            var m = '';
            $.each(_months, function(index,value) {
                m += '<option value="'+ value.id +'">' + value.name + '</option>'
            });
            $("select[name=month]").html(m);

            @if(isset($_GET['year']))
            $("select[name=year]").val("{{ $_GET['year'] }}");
            $("select[name=month]").val("{{ $_GET['month'] }}");
            @endif
        });
    </script>

@endsection