@extends('master')
@section('judul_halaman')
    Riwayat Rekam Medis
@endsection
{{-- @section('deskripsi_halaman')
    Pilih pasien untuk melihat riwayat rekam medis
@endsection --}}
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

    @if (!isset($idens))
        @include('layouts.list_pasien', ['input_page' => false])
    @endif

    @if (isset($idens))
        @include('layouts.identitas')

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#PilihPasien" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="PilihPasien">
                <h6 class="m-0 font-weight-bold text-primary">Jejak Rekam Medis</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="PilihPasien" style="">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="pasien" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tanggal Periksa</th>
                                    <th>Keluhan Utama</th>
                                    <th>Lab</th>
                                    <th>Diagnosis</th>
                                    <th>Obat</th>
                                    <th>Status Lab</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rms as $rm)
                                    <tr>
                                        <td>{{ str_pad($rm->id_rm, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ format_date($rm->created_at) }}</td>
                                        <td>{{ $rm->keluhan }}</td>
                                        <td>
                                            @if ($rm->id_labs != null AND $rm->status_lab !== 1)
                                                @for ($i = 0; $i < sizeof($lab = encode($rm->id_labs)); $i++)
                                                    @if ($has = encode($rm->hasil_labs))
                                                        <li>{{ get_value('labs', $lab[$i], 'nama', 'id_lab') }} : {{ $has[$i] }}
                                                            {{ get_value('labs', $lab[$i], 'satuan', 'id_lab') }}</li>
                                                    @endif
                                                @endfor
                                            @endif
                                        </td>
                                        <td>{{ $rm->diagnosis->kode }} - {{ $rm->diagnosis->nama_id }}</td>
                                        <td>
                                            @if ($rm->id_obats != null)
                                                @for ($i = 0; $i < sizeof($resep = encode($rm->id_obats)); $i++)
                                                    @if ($aturan = encode($rm->aturan_obats))
                                                        <li>{{ get_value('obats', $resep[$i], 'nama_obat', 'id_obat') }}
                                                            {{ get_value('obats', $resep[$i], 'jenis', 'id_obat') }}
                                                            {{ get_value('obats', $resep[$i], 'dosis', 'id_obat') }}
                                                            {{ get_value('obats', $resep[$i], 'satuan', 'id_obat') }}: {{ $aturan[$i] }}
                                                        </li>
                                                    @endif
                                                @endfor
                                            @endif
                                        </td>
                                        <td>
                                            @if ($rm->status_lab === 1)
                                                <span class="btn btn-secondary btn-sm btn-icon-split">
                                                    <span class="text">Periksa Lab</span>
                                            @else
                                                <span class="btn btn-success btn-sm btn-icon-split">
                                                    <span class="text">Selesai</span>
                                            @endif
                                        </td>
                                        <td width="120px">
                                            <a href="{{ route('rm.lihat', $rm->id_rm) }}"
                                                class="btn btn-success btn-sm btn-icon-split">
                                                <span class="icon">
                                                    <i style="padding-top:4px"class="fas fa-eye"></i>
                                                </span>
                                                <span class="text">Lihat</span>
                                            </a>
                                            <a href="{{ route('rm.edit', $rm->id_rm) }}"
                                                class="btn btn-primary btn-sm btn-icon-split">
                                                <span class="icon">
                                                    <i style="padding-top:4px"class="fas fa-pen"></i>
                                                </span>
                                                <span class="text">Edit</span>
                                            </a>
                                            <a href="javascript:;" data-toggle="modal"
                                                onclick="deleteData({{ $rm->id_rm }})" data-target="#DeleteModal"
                                                class="btn btn-sm btn-icon-split btn-danger">
                                                <span class="icon"><i class="fa  fa-trash"
                                                        style="padding-top: 4px;"></i></span><span
                                                    class="text">Hapus</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        $(document).ready(function() {
            var table = $('#pasien').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ]
            })
        });
    </script>

    <script>
        function deleteData(id) {
            var id = id;
            var url = '{{ route('rm.hapus', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>

@endsection
