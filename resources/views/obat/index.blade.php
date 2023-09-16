@extends('master')
@section('judul_halaman')
    Daftar Obat
@endsection
@section('deskripsi_halaman')
    Daftar obat-obatan yang terdaftar di klinik
@endsection
@section('content')

    <!--Modal Konfirmasi Delete-->
    <div id="DeleteModal" class="modal fade text-danger" role="dialog">
        <div class="modal-dialog modal-dialog modal-dialog-centered ">
            <!-- Modal content-->
                <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title text-center text-white">Konfirmasi Penghapusan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p class="text-center">Apakah anda yakin untuk menghapus Obat? Data yang sudah dihapus tidak
                            bisa kembali</p>
                    </div>
                    <div class="modal-footer">
                        <center>
                            <button type="button" class="btn btn-success" data-dismiss="modal">Tidak, Batal</button>
                            <button type="button" name="" class="btn btn-danger" data-dismiss="modal"
                                onclick="formSubmit()">Ya, Hapus</button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--End Modal-->

    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
            <a href="{{ route('obat.excel') }}" class="d-none d-sm-inline-block btn btn-success btn-sm shadow-sm">
                <i class="fas fa-plus fa-sm"></i>  Upload Excel</a>
            <a href="{{ route('obat.tambah') }}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-plus fa-sm"></i>  Tambah Obat</a>
        </div>
        <div class="card-header d-sm-flex align-items-center justify-content-left py-3">
            <a href="{{ route('obat.export_excel') }}" class="d-none d-sm-inline-block btn btn-success btn-sm shadow-sm">
                <i class="fas fa-file-excel"></i>  Download Stok Obat</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 950px;">Nama Obat</th>
                            <th>Jenis</th>
                            <th>Dosis</th>
                            <th>Stok</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obats as $obat)
                            <tr>
                                <td>{{ $obat->nama_obat }}</td>
                                <td>{{ $obat->jenis }}</td>
                                <td>{{ $obat->dosis }} {{ $obat->satuan }}</td>
                                <td>{{ $obat->stok }}</td>
                                <td>
                                    <a href="{{ route('obat.edit', $obat->id_obat) }}"
                                        class="btn btn-sm btn-icon-split btn-warning">
                                        <span class="icon"><i class="fa fa-pen" style="padding-top: 4px;"></i></span><span
                                            class="text">Edit</span>
                                    </a>
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{ $obat->id_obat }})"
                                        data-target="#DeleteModal" class="btn btn-sm btn-icon-split btn-danger">
                                        <span class="icon"><i class="fa  fa-trash"
                                                style="padding-top: 4px;"></i></span><span class="text">Hapus</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deleteData(id) {
            var id = id;
            var url = '{{ route('obat.hapus', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>

@endsection
