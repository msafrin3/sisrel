@extends('layouts.main')
@section('title', 'Daftar Borang Levi')
@section('levi', 'active')
@section('content')

    <section class="content-header">
        <h1>Daftar Borang Levi</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}">Laman Utama</a></li>
            <li><a href="{{ url('levi') }}">Daftar Levi</a></li>
            <li class="active">Borang Daftar Levi</li>
        </ul>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Borang rekod pendaftaran levi</h3>
                    </div>
                    <div class="box-body">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label>No. Eksais / Pendaftaran</label>
                                <input type="text" class="form-control" name="registration_no" value="{{ old('registration_no') }}" readonly>
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
                                <input type="date" class="form-control" name="date" value="{{ old('date') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Berat (Matrik Tan)</label>
                                <input type="number" step="any" name="weight" class="form-control changes" value="{{ old('weight') }}">
                            </div>
                            <div class="form-group">
                                <label>Harga Per Matrik Tan</label>
                                <input type="number" step="any" name="price" class="form-control changes price-per-weight" value="51.60">
                            </div>
                            <div class="form-group">
                                <label>Jumlah Bayaran (RM)</label>
                                <input type="number" step="any" name="total_payment" class="form-control" value="{{ old('total_payment') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Penalti (RM)</label>
                                <input type="number" step="any" name="penalty" class="form-control" value="{{ old('penalty') }}">
                            </div>
                            <div class="form-group">
                                <label>No. Resit</label>
                                <input type="text" name="resit_no" class="form-control" placeholder="Masukkan Nombor Resit" value="{{ old('resit_no') }}">
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

        // $(document).on("change", "input[name=weight]", function() {
        //     var total = ($(this).val() == null || $(this).val() == '' ? 0 : parseFloat($(this).val())) * 51.6;
        //     $("input[name=total_payment]").val(total.toFixed(2));
        // });

        $(document).on("change", ".changes", function() {
            var weight = ($("input[name=weight]").val() == null || $("input[name=weight]").val() == '' ? 0 : parseFloat($("input[name=weight]").val()));
            var price = ($("input[name=price]").val() == null || $("input[name=price]").val() == '' ? 0 : parseFloat($("input[name=price]").val()));
            var total = price * weight;
            $("input[name=total_payment]").val(total.toFixed(2));
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