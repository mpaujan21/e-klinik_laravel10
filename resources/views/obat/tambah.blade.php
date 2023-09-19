@extends('master')
@section('judul_halaman')
    Tambah Obat
@endsection
{{-- @section('deskripsi_halaman')
    Tambahkan obat baru dengan mengisi formulir berikut
@endsection --}}
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Obat Baru</h6>
        </div>

        <div class="card-body">
            <form class="user" action="{{ route('obat.simpan') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="nama_obat">Nama Obat</label>
                        <input type="text" class="form-control " name="nama_obat">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label for="jenis">Jenis Obat</label>
                        <select class="form-control " name="jenis">
                            <option value="" selected disabled>Jenis Obat</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Syrup">Syrup</option>
                            <option value="Ampul">Ampul</option>
                            <option value="Flask">Flask</option>
                        </select>
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label for="dosis">Dosis Obat</label>
                        <input type="text" class="form-control " name="dosis" placeholder="Dosis Obat">
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label for="satuan">Satuan Obat</label>
                        <select class="form-control " name="satuan" placeholder="satuan">
                            <option value="" selected disabled>Satuan</option>
                            <option value="g">g</option>
                            <option value="mg">mg</option>
                            <option value="mcg">mcg</option>
                            <option value="IU">IU</option>
                            <option value="mg/5ml">mg/5ml</option>
                        </select>
                    </div>
                </div>

                <label for="stok">Jumlah Obat</label>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-hashtag fa-fw"></i></div>
                            </div>
                            <input type="text" class="form-control " name="stok" placeholder="Jumlah Stok Obat">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <a href="{{ route('obat') }}" class="btn btn-danger btn-block btn">
                            <i class="fas fa-arrow-left fa-fw"></i> Kembali
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-block" name="simpan" value="simpan">
                            <i class="fas fa-save fa-fw"></i> Simpan
                        </button>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-warning btn-block" name="simpan" value="simpan_baru">
                            <i class="fas fa-plus fa-fw"></i> Simpan Dan Buat Baru
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection
