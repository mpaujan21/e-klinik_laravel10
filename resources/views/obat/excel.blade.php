@extends('master')
@section('judul_halaman')
    Upload Obat
@endsection
@section('deskripsi_halaman')
    {{-- Upload excel stok obat --}}
@endsection
@section('content')
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#UploadExcel" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
            aria-controls="ListRM">
            <h6 class="m-0 font-weight-bold text-primary">Upload Data Obat</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="card-header d-sm-flex align-items-center justify-content-left py-3">
            <a href="{{ route('obat.export_excel') }}" class="d-none d-sm-inline-block btn btn-success btn-sm shadow-sm">
                <i class="fas fa-file-excel"></i>  Download Template (Stok obat saat ini)</a>
        </div>
        <div class="collapse show" id="UploadExcel" style="">
            <div class="card-body">
                <form class="user" action="{{ route('obat.import_excel') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <label>Pilih file excel</label>
                            <div class="form-group2">
                                <input type="file" name="file" required="required">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
