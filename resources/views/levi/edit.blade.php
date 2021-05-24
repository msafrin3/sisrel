@extends('layouts.main')
@section('title', 'Daftar Borang Levi')
@section('levi', 'active')
@section('content')

    <section class="content-header">
        <h1>Daftar Borang Levi</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}">Laman Utama</a></li>
            <li><a href="{{ url('levi') }}">Daftar Levi</a></li>
            <li class="active">Kemaskini levi</li>
        </ul>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kemaskini maklumat levi</h3>
                    </div>
                    <div class="box-body">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label>No. Eksais / Pendaftaran</label>
                                <input type="text" class="form-control" name="registration_no" value="{{ $levi->registration_no }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Pilih Syarikat / Pelesen</label>
                                <select name="pelesen_id" class="form-control">
                                    @foreach($pelesens as $pelesen)
                                    <option value="{{ $pelesen->id }}">{{ $pelesen->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tarikh bayaran</label>
                                <input type="date" class="form-control" name="date" value="{{ $levi->date }}" required>
                            </div>
                            <div class="form-group">
                                <label>Berat (Matrik Tan)</label>
                                <input type="number" step="any" name="weight" class="form-control" value="{{ $levi->weight }}">
                            </div>
                            <div class="form-group">
                                <label>Jumlah Bayaran (RM)</label>
                                <input type="number" step="any" name="total_payment" class="form-control" value="{{ $levi->total_payment }}">
                            </div>
                            <div class="form-group">
                                <label>Jumlah Penalti (RM)</label>
                                <input type="number" step="any" name="penalty" class="form-control" value="{{ $levi->penalty }}">
                            </div>
                            <div class="form-group">
                                <label>No. Resit</label>
                                <input type="text" name="resit_no" class="form-control" placeholder="Masukkan Nombor Resit" value="{{ $levi->resit_no }}">
                            </div>

                            <div style="text-align:center;">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save fa-fw"></i> Simpan</button>
                                <a href="{{ url('levi') }}" class="btn btn-default btn-block">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('footerScripts')

    <script>
        $(document).on("change", "input[name=date]", function() {
            var date = $(this).val();
            getRunningNumber(date);
        });

        function getRunningNumber(date) {
            $.ajax({
                url: "{{ url('levi/getRunningNumber') }}",
                type: "GET",
                data: "date=" + date,
                success: function(response) {
                    console.log(response);
                    $("input[name=registration_no]").val(response);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    </script>

@endsection