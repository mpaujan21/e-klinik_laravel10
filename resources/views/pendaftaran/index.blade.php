@extends('master')
{{-- @section('judul_halaman')
    Pendaftaran
@endsection
@section('deskripsi_halaman')
    {{ $metadata->deskripsi }}
@endsection --}}
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pendaftaran Jadwal Kunjungan</h6>
        </div>
        @livewire('form-daftar')
    </div>
@endsection
