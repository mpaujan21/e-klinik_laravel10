@extends('master')
@section('judul_halaman')
@endsection
@section('deskripsi_halaman')
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
                        <p class="text-center">Apakah anda yakin untuk menghapus Rekam Medis? Data yang sudah dihapus tidak
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
        <!-- Card Header - Accordion -->
        <a class="d-block card-header py-3">
            @if (empty($kunjungans))
                <h5 class="m-0 font-weight-bold text-primary">Tidak ada jadwal kunjungan untuk {{ $name }}</h5>
            @else
                <h5 class="m-0 font-weight-bold text-primary">Jadwal Kunjungan {{ $name }}</h5>
            @endif
        </a>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
			@foreach ($kunjungans as $kunjungan)
				<div class="col-lg-6">
					<div class="card shadow mb-4">
						<div align="center" class="card-body">
							<h4 class="m-0 font-weight-bold text-primary">No Antrian</h4>
							<h1 class="m-0 font-weight-bold text-primary">{{ $kunjungan->no_antrian }}</h1>
							<div>{{ 'Tanggal Kunjungan: ' . $kunjungan->jadwal->tanggal }}</div>
							<div>{{ 'Dokter: ' . $kunjungan->jadwal->dokter->user->nama }}</div>
							@if ($kunjungan->jadwal->dokter->id_poli === 1)
								<div>Poli Umum</div>
							@else
								<div>Poli Gigi</div>
							@endif
						</div>

						<div class="form-group row">
							<div class="col-sm-6 pl-5">
								<a href="javascript:;" data-toggle="modal" onclick="deleteData({{ $kunjungan->id_kunjungan }})" data-target="#DeleteModal" class="btn btn-danger btn-block btn">
									<i class="fas fa-trash fa-fw"></i> Batalkan Kunjungan
								</a>
							</div>
							<div class="col-sm-6 pr-5">
								<button type="submit" class="btn btn-primary btn-block" name="simpan" value="simpan" >
									<i class="fas fa-info-circle fa-fw"></i> Reschedule Kunjungan
								</button>
							</div>  
						</div>
					</div>
				</div>
            @endforeach
        </div>
    </div>

	<script>
        function deleteData(id) {
            var id = id;
            var url = '{{ route('jadwal.hapus', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>

@endsection
