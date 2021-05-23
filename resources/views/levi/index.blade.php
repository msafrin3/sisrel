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
                                @elseif($levi->status == 'DISEMAK')
                                <label class="label label-warning">{{ $levi->status }}</label>
                                @elseif($levi->status == 'DIBAYAR')
                                <label class="label label-success">{{ $levi->status }}</label>
                                @endif
                            </td>
                            <td style="text-align:center;white-space:nowrap">
                                @role('officer')
                                <a href="{{ url('levi/show/'.$levi->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('levi/edit/'.$levi->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                @endrole
                                @role('confirm_officer')
                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Pengesahan Levi"><i class="fa fa-thumbs-up"></i></button>
                                @endrole
                                @role('payment_officer')
                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Pengesahan Bayaran"><i class="fa fa-money"></i></button>
                                @endrole
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection