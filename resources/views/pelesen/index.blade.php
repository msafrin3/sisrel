@extends('layouts.main')
@section('title', 'Senarai Pelesen')
@section('pelesen', 'active')
@section('pelesen_list', 'active')
@section('content')

    <section class="content-header">
        <h1>Senarai Pelesen</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}">Laman Utama</a></li>
            <li class="active">Senarai Pelesen</li>
        </ul>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Maklumat Pelesen</h3>
                <div class="pull-right">
                    <a href="{{ url('pelesen/add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle fa-fw"></i> Tambah Baru Pelesen</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Syarikat</th>
                            <th>No. Lesen</th>
                            <th>No. Fail</th>
                            <th>Pengurus / Akauntan</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        @foreach($pelesens as $pelesen)
                        <?php $count++; ?>
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $pelesen->company_name }}</td>
                            <td>{{ $pelesen->license_no }}</td>
                            <td>{{ $pelesen->file_no }}</td>
                            <td>{{ $pelesen->accountant_name }}</td>
                            <td>{{ $pelesen->created_at }}</td>
                            <td style="text-align:center;white-space:nowrap">
                                <a href="{{ url('pelesen/show/'.$pelesen->id) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('pelesen/edit/'.$pelesen->id) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection