@extends('master')
{{-- @foreach ($metadatas as $metadata)
    @section('judul_halaman')
        {{ $metadata->Judul }}
    @endsection
    @section('deskripsi_halaman')
        {{ $metadata->Deskripsi }}
    @endsection
@endforeach --}}
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

    @include('layouts.identitas')

    @foreach ($datas as $data)
        <div class="card shadow mb-4">
            <a href="#tambahrm" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
                aria-controls="tambahrm">
                <h6 class="m-0 font-weight-bold text-primary">Rekam Medis Pasien</h6>
            </a>
            <div class="collapse show" id="tambahrm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12" align="right">
                            <a href="{{ route('rm.edit', $data->id_rm) }}" class="btn btn-warning btn-icon-split">
                                <span class="icon">
                                    <i style="padding-top:4px"class="fas fa-pen"></i>
                                </span>
                                <span class="text">Edit</span>
                            </a>
                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{ $data->id_rm }})"
                                data-target="#DeleteModal" class="btn btn-icon-split btn-danger">
                                <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span
                                    class="text">Hapus Rekam Medis</span></a>
                        </div>
                    </div>
                    {{-- <form class="user" action="{{ route('rm.update') }}" method="post"> --}}
                    <form class="user" action="#" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" name="idpasien" value="{{ $data->id_pasien }}">
                        <input type="hidden" name="id" value="{{ $data->id_rm }}">
                        <div class="form-group row">
                            <div class="col-sm-2 text-md-right">
                                <label for="keluhan-utama"><strong>Tanggal Periksa</strong></label>
                            </div>
                            <div class="col-sm-1 text-md-left">
                                :
                            </div>
                            <div class="col-sm-8">
                                <p class="text-md-left">{{ format_date($data->created_at) }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-md-right">
                                <label><strong>Dokter Pemeriksa</strong></label>
                            </div>
                            <div class="col-sm-1 text-md-left">
                                :
                            </div>
                            <div class="col-sm-8">
                                <p class="text-md-left">{{ $data->dokter->user->nama }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-md-right">
                                <label for="keluhan-utama"><strong>Keluhan Utama</strong></label>
                            </div>
                            <div class="col-sm-1 text-md-left">
                                :
                            </div>
                            <div class="col-sm-8">
                                <p class="text-md-left">{{ $data->keluhan }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-md-right">
                                <label for="keluhan-utama"><strong>Anamnesis</strong></label>
                            </div>
                            <div class="col-sm-1 text-md-left">
                                :
                            </div>
                            <div class="col-sm-8">
                                <p class="text-md-left">{{ $data->anamnesis }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-md-right">
                                <label for="keluhan-utama"><strong>Pemeriksaan Fisik</strong></label>
                            </div>
                            <div class="col-sm-1 text-md-left">
                                :
                            </div>
                            <div class="col-sm-8">
                                <p class="text-md-left">{{ $data->pfisik }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-md-right">
                                <label for="keluhan-utama"><strong>Diagnosis</strong></label>
                            </div>
                            <div class="col-sm-1 text-md-left">
                                :
                            </div>
                            <div class="col-sm-8">
                                <p class="text-md-left">{{ $data->diagnosis->kode }} - {{ $data->diagnosis->nama_id }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-md-right">
                                <label for="keluhan-utama"><strong>Pemeriksaan Lab</strong></label>
                            </div>
                            <div class="col-sm-1 text-md-left">
                                :
                            </div>
                            <div class="col-sm-8">
                                @if ($data->id_labs != null)
                                    @for ($i = 0; $i < $num['lab']; $i++)
                                        <li> {{ get_value('labs', array_keys($data->labhasil)[$i], 'nama', 'id_lab') }} :
                                            {{ $data->labhasil[array_keys($data->labhasil)[$i]] }}
                                            {{ get_value('labs', array_keys($data->labhasil)[$i], 'satuan', 'id_lab') }} </li>
                                    @endfor
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-md-right">
                                <label for="keluhan-utama"><strong>Resep</strong></label>
                            </div>
                            <div class="col-sm-1 text-md-left">
                                :
                            </div>

                            <div class="col-sm-8">
                                @if ($data->id_obats != null)
                                    @for ($i = 0; $i < $num['resep']; $i++)
                                        <li class="text-md-left">
                                            {{ get_value('obats', array_keys($data->allresep)[$i], 'nama_obat', 'id_obat') }}
                                            {{ get_value('obats', array_keys($data->allresep)[$i], 'jenis', 'id_obat') }}
                                            {{ get_value('obats', array_keys($data->allresep)[$i], 'dosis', 'id_obat') }}
                                            {{ $data->allresep[array_keys($data->allresep)[$i]] }}</li>
                                    @endfor
                                @endif
                            </div>

                        </div>
                        <br>
                        {{-- <div class="form-group row">
                            </div>
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <a href="javascript:;" data-toggle="modal" onclick="print()"
                                    class="btn btn-primary btn-block">
                                    <span class="icon"><i class="fa  fa-print"></i></span><span class="text">
                                        Cetak</span></a>
                            </div> --}}
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script type="text/javascript">
        function deleteData(id) {
            var id = id;
            var url = '{{ route('rm.hapus', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }

        function print() {
            $('#PrintRM').printThis();
        }
    </script>
@endsection
