@extends('master')
{{-- @foreach ($metadatas as $metadata)
    @section('judul_halaman')
        {{ $metadata->judul }}
    @endsection
    @section('deskripsi_halaman')
        {{ $metadata->deskripsi }}
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
                <h6 class="m-0 font-weight-bold text-primary">Edit Rekam Medis</h6>
            </a>
            </a>
            <div class="collapse show" id="tambahrm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12" align="right">
                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{ $data->id_rm }})"
                                data-target="#DeleteModal" class="btn btn-icon-split btn-danger">
                                <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span
                                    class="text">Hapus Rekam Medis</span></a>
                        </div>
                    </div>
                    <form class="user" action="{{ route('rm.update', $data->id_rm) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="idpasien" value="{{ $data->id_pasien }}">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-group row col-sm-12">
                            <label for="dokter">Dokter Pemeriksa</label>
                            <select class="form-control " name="dokter">
                                {{-- {{ Auth::user()->admin !== 1 ? 'disabled="true"' : '' }}> --}}
                                @foreach ($dokters as $dokter)
                                    <option value="{{ $dokter->id_dokter }}">
                                        {{-- {{ $dokter->username === Auth::user()->username ? 'selected' : '' }}>{{ $dokter->user->nama }} --}}
                                        {{ $dokter->user->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row col-sm-12">
                            <label for="keluhan-utama">Keluhan Utama</label>
                            <input type="text" class="form-control " name="keluhan_utama" value="{{ $data->keluhan }}"
                                required>
                        </div>
                        <div class="form-group row col-sm-12  ">
                            <label for="anamnesis">Anamnesis</label>
                            <textarea type="date" class="form-control " name="anamnesis" required>{{ $data->anamnesis }}</textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="pemeriksaan_fisik">Pemeriksaan Fisik</label>
                                <textarea type="date" class="form-control " name="px_fisik" required>{{ $data->pfisik }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="diagnosis">Diagnosis</label>
                                <select class="form-control " name="diagnosis" id="diagnosis">
                                    {{-- {{ Auth::user()->profesi !== 'Dokter' ? 'disabled="true"' : '' }}> --}}
                                    {{-- <option value="{{ $data->diagnosis }}" selected disabled>{{ $data->diagnosis->kode }} - {{ $data->diagnosis->nama }}</option> --}}
                                    @foreach ($icds as $icd)
                                        <option value="{{ $icd->id_diagnosis }}">{{ $icd->kode }} - {{ $icd->nama_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group2 row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="penunjang">Pemeriksaan Penunjang</label>
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select num="{{ $num['lab'] }}" class="form-control "id="penunjang" name="penunjang">
                                    <option value="" selected disabled>Pilih satu</option>
                                    @foreach ($labs as $lab)
                                        <option satuan="{{ $lab->satuan }}" value="{{ $lab->id }}">{{ $lab->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <a href="javascript:;" onclick="addpenunjang()" type="button" name="add"
                                    id="add" class="btn btn-success">Tambahkan</a>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <table id="dynamicTable" width="75%">
                                    @if ($data->id_labs != null)
                                        @for ($i = 0; $i < $num['lab']; $i++)
                                            <tr>
                                                <input type="hidden" name="lab[{{ $i }}][id]"
                                                        value="{{ array_keys($data->labhasil)[$i] }}"
                                                        class="form-control" readonly>
                                                <td width="30%"><input type="text"
                                                        name="lab[{{ $i }}][nama]"
                                                        value="{{ get_value('labs', array_keys($data->labhasil)[$i], 'nama', 'id_lab') }}"
                                                        class="form-control" readonly></td>
                                                <td width="10%"><input type="text"
                                                        name="lab[{{ $i }}][hasil]"
                                                        value="{{ $data->labhasil[array_keys($data->labhasil)[$i]] }}"
                                                        placeholder="Hasil" class="form-control" readonly>
                                                <td width=10%"><input class="form-control"
                                                        value='{{ get_value('labs', array_keys($data->labhasil)[$i], 'satuan', 'id_lab') }}'
                                                        readonly></td>
                                                </td>
                                            </tr>
                                        @endfor
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="form-group2 row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="reseplist">Resep</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9 mb-0 mb-sm-0">
                                {{-- <select num="{{ $num['resep'] }}" class="form-control " name="reseplist"
                                    id="reseplist">
                                    <option value="" selected disabled>Pilih satu</option>
                                    @foreach ($obats as $obat)
                                        <option value="{{ $obat->id }}">{{ $obat->nama_obat }} {{ $obat->jenis }}
                                            {{ $obat->dosis }}{{ $obat->satuan }}</option>
                                    @endforeach
                                </select> --}}
                                <select class="selectpicker form-control" name="reseplist" id="reseplist" data-live-search="true" title="Pilih Obat">
                                    @foreach ($obats as $obat)
                                        <option value="{{ $obat->id_obat }}">{{ $obat->nama_obat }} {{ $obat->sediaan }} {{ $obat->dosis }}{{ $obat->satuan }} - Stok: {{ $obat->stok }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <a href="javascript:;" onclick="addresep()" type="button" name="addresep"
                                    id="addresep" class="btn btn-success">Tambahkan</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <table width="75%" id="reseps">
                                    @if ($data->id_obats != null)
                                        @for ($i = 0; $i < $num['resep']; $i++)
                                            <tr>
                                                <td><input type="hidden" name="resep[{{ $i }}][id]"
                                                        value="{{ array_keys($data->allresep)[$i] }}"
                                                        class="form-control" readonly></td>
                                                <td width="30%"><input type="text"
                                                        name="resep[{{ $i }}][nama]"
                                                        value="{{ get_value('obats', array_keys($data->allresep)[$i], 'nama_obat', 'id_obat') }} {{ get_value('obats', array_keys($data->allresep)[$i], 'jenis', 'id_obat') }} {{ get_value('obats', array_keys($data->allresep)[$i], 'dosis', 'id_obat') }} {{ get_value('obats', array_keys($data->allresep)[$i], 'satuan', 'id_obat') }}"
                                                        class="form-control" readonly></td>
                                                <td width="10%"><input type="text"
                                                        name="resep[{{ $i }}][jumlah]"
                                                        value="{{ $data->jum[$i] }}" placeholder="Jumlah"
                                                        class="form-control" required></td>
                                                <td width="30%"><input type="text"
                                                        name="resep[{{ $i }}][aturan]"
                                                        value="{{ $data->allresep[array_keys($data->allresep)[$i]] }}"
                                                        placeholder="Aturan" class="form-control" required></td>
                                                <td><button type="button"
                                                        class="btn btn-danger remove-pen">Hapus</button></td>
                                            </tr>
                                        @endfor
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                @foreach ($idens as $iden)
                                    <a href="{{ route('rm.riwayat.id', $iden->id_pasien) }}" class="btn btn-danger btn-block"
                                        name="simpan">
                                        <i class="fas fa-arrow-left fa-fw"></i> Kembali
                                    </a>
                                @endforeach
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <button type="submit" class="btn btn-primary btn-block" name="simpan"
                                    value="simpan_edit">
                                    <i class="fas fa-save fa-fw"></i> Simpan
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

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

    <script type="text/javascript">
        var i = 0;
        var a = 0;

        function addpenunjang() {
            var pen = $("#penunjang option:selected").html();
            var penid = $("#penunjang").val();
            var satuan = $("#penunjang option:selected").attr('satuan');
            if (penid !== null) {
                $("#dynamicTable").append('<tr><td><input type="hidden" name="lab[' + i + '][id]" value="' + penid +
                    '" class="form-control" readonly></td><td width="30%"><input type="text" name="lab[' + i +
                    '][nama]" value="' + pen +
                    '" class="form-control" readonly></td><td width="0%"><input type="hidden" name="lab[' + i +
                    '][hasil]" value="0" class="form-control" required></td></td><td><button type="button" class="btn btn-danger remove-pen">Hapus</button></td></tr>'
                );
            }
            ++i;
        };

        function addresep() {
            var res = $("#reseplist option:selected").html();
            var resid = $("#reseplist").val();
            if (resid !== null) {
                //code
                $("#reseps").append('<tr><td><input type="hidden" name="resep[' + a + '][id]" value="' + resid +
                    '" class="form-control" readonly></td><td width="30%"><input type="text" name="resep[' + a +
                    '][nama]" value="' + res +
                    '" class="form-control" readonly></td><td width ="10%"><input type="text" name="resep[' + a +
                    '][jumlah]" placeholder="Jumlah" class="form-control" required><td width="30%"><input type="text" name="resep[' +
                    a +
                    '][aturan]" placeholder="Aturan pakai" class="form-control" required></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></td></tr>'
                );
            }
            ++a;
        };

        $(document).on('click', '.remove-pen', function() {
            $(this).parents('tr').remove();
        });

        $(document).on('click', '.remove-res', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
