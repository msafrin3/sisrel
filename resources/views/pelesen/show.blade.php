@extends('layouts.main')
@section('title', $pelesen->company_name)
@section('pelesen', 'active')
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
                <h3 class="box-title">Maklumat Pelesen</h3>
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
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Rekod pembayaran levi</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Eksais</th>
                            <th>Tarikh Pembayaran</th>
                            <th>Berat (Matrik tan)</th>
                            <th>Jumlah bayaran (RM)</th>
                            <th>Penalti (RM)</th>
                            <th>No. Resit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        @foreach($pelesen->Levis()->orderBy('date')->get() as $levi)
                        <?php $count++; ?>
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $levi->registration_no }}</td>
                            <td>{{ date('D M Y', strtotime($levi->date)) }}</td>
                            <td>{{ number_format($levi->weight, 2) }}</td>
                            <td>{{ number_format($levi->total_payment, 2) }}</td>
                            <td>{{ number_format($levi->penalty, 2) }}</td>
                            <td>{{ $levi->resit_no }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="print-content" style="margin-top: 20px;text-align:center">
            <button type="button" class="btn btn-default" onclick="window.print()"><i class="fa fa-print fa-fw"></i> Print</button>
        </div>
    </section>

@endsection