@extends('layouts.main')
@section('title', 'Tambah baru pelesen')
@section('pelesen', 'active')
@section('pelesen_add', 'active')
@section('content')

    <section class="content-header">
        <h1>Tambah Baru Pelesen</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}">Laman Utama</a></li>
            <li><a href="{{ url('pelesen') }}">Pelesen</a></li>
            <li class="active">Tambah Baru Pelesen</li>
        </ul>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Borang Kemaskini Maklumat Pelesen</h3>
            </div>
            <div class="box-body">
                <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nama Syarikat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="company_name" placeholder="Masukkan nama syarikat" value="{{ $pelesen->company_name }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">No. Lesen</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="license_no" placeholder="Masukkan nombo lesen syarikat" value="{{ $pelesen->license_no }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">No. Fail</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="file_no" placeholder="Masukkan nombo fail" value="{{ $pelesen->file_no }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Alamat</label>
                            <div class="col-sm-9">
                                <textarea name="address" class="form-control" rows="10" placeholder="Masukkan alamat syarikat">{{ $pelesen->address }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nama Pengurus / Akauntan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="accountant_name" placeholder="Masukkan nama pengurus syarikat" value="{{ $pelesen->accountant_name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" placeholder="Email syarikat" value="{{ $pelesen->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">No. Tel syarikat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="contact_no" placeholder="No Telefon Syarikat" value="{{ $pelesen->contact_no }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Keluasan Hektar Ladang</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="area" placeholder="Keluasan hektar ladang" value="{{ $pelesen->area }}">
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Lampiran</label>
                            <div class="col-sm-9">
                                <table style="width:40%">
                                    <tbody>
                                        @foreach($pelesen->Attachments as $attachment)
                                        <tr class="attachment{{ $attachment->id }}">
                                            <td><a href="{{ url('') }}/storage/attachment/{{ $attachment->file_name }}" target="_blank">{{ $attachment->file_name }}</a></td>
                                            <td><a href="javascript:;" class="text-danger" onclick="deleteAttachment('{{ $attachment->id }}')"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Muat Naik Lampiran <a href="javascript:;" class="add-attachment" style="margin-left:10px;"><i class="fa fa-plus-circle"></i></a></label>
                            <div class="col-sm-9 attachment-content">
                                <div class="row" style="margin-bottom:10px;">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="attachment[0][title]" placeholder="Tajuk Lampiran">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="file" class="form-control" name="attachment[0][file]">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i> Padam</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="text-align:center;margin-top:20px">
                        <a href="{{ url('pelesen') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@section('footerScripts')

    <script>
        var count = 0;
        $(document).on("click", ".add-attachment", function() {
            count++;
            $(".attachment-content").append(
                '<div class="row attachment-item" style="margin-bottom:10px;">'+
                    '<div class="col-md-3">'+
                        '<input type="text" class="form-control" name="attachment['+ count +'][title]" placeholder="Tajuk Lampiran">'+
                    '</div>'+
                    '<div class="col-md-3">'+
                        '<input type="file" class="form-control" name="attachment['+ count +'][file]">'+
                    '</div>'+
                    '<div class="col-md-2">'+
                        '<button type="button" class="btn btn-danger btn-delete-attachment"><i class="fa fa-trash fa-fw"></i> Padam</button>'+
                    '</div>'+
                '</div>'
            )
        });

        $(document).on("click", ".btn-delete-attachment", function() {
            $(this).parents(".attachment-item").remove();
        });

        function deleteAttachment(id) {
            var r = confirm("Padam lampiran?");
            if(r) {
                $.ajax({
                    url: "{{ url('') }}/pelesen/delete/attachment/" + id,
                    type: "POST",
                    data: "_token={{ csrf_token() }}",
                    success: function(response) {
                        if(response.status == 'success') {
                            toastr.success(response.message);
                            $(".attachment" + id).remove();
                        } else {
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