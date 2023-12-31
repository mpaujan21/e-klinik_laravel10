@extends('master')
{{-- @foreach ($metadatas as $metadata) --}}
    @section('judul_halaman')
        Input Rekam Medis
    @endsection
    {{-- @section('deskripsi_halaman')
        Pilih pasien untuk menginput rekam medis
    @endsection --}}
{{-- @endforeach --}}
@section('content')

    {{-- Selectpicker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Modal -->
    {{-- @include('layouts.list_diagnosis', ['icds' => $icds]) --}}

    @if (!isset($idens))
        @include('layouts.list_pasien', ['input_page' => true])
    @endif

    @if (isset($idens))
        @include('layouts.identitas')

        <div class="card shadow mb-4">
            <a href="#tambahrm" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
                aria-controls="tambahrm">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Rekam Medis</h6>
            </a>
            <div class="collapse show" id="tambahrm">
                <div class="card-body">
                    <form class="user" action="{{ route('rm.simpan') }}" method="post">
                        {{ csrf_field() }}
                        @foreach ($idens as $iden)
                            <input type="hidden" name="id_pasien" value="{{ $iden->id_pasien }}">
                        @endforeach
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="dokter">Dokter Pemeriksa</label>
                                <select class="form-control " name="id_dokter" {{ Auth::user()->role === 3 ? 'disabled="true"' : '' }}>
                                    @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->id_dokter }}" 
                                            {{ $dokter->username === Auth::user()->username ? 'selected' : '' }}>{{ $dokter->user->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="keluhan-utama">Keluhan Utama</label>
                                <input type="text" class="form-control " name="keluhan_utama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="anamnesis">Anamnesis</label>
                                <textarea type="date" class="form-control" name="anamnesis" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="pemeriksaan_fisik">Pemeriksaan Fisik</label>
                                <textarea type="date" class="form-control" name="pfisik" required></textarea>
                            </div>
                        </div>
                        {{-- BACKUP
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="diagnosis">Diagnosis</label>
                                <select class="form-control" name="id_diagnosis" id="id_diagnosis">
                                    <option value="" selected disabled>Pilih satu</option>
                                    @foreach ($icds as $icd)
                                        <option value="{{ $icd->id_diagnosis }}">{{ $icd->kode }} - {{ $icd->nama_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

                        {{-- BACKUP 2
                        <div class="form-group2 row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="diagnosis">Diagnosis</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 mb-3 mb-sm-0">
                                <input type="hidden" class="form-control"  id="id_diagnosis" name="id_diagnosis" readonly>
                                <input type="text" class="form-control" id="diagnosis" name="diagnosis" readonly>
                            </div>
                            <div class="col-sm-3">
                                <a data-toggle="modal" data-target="#DiagnosisModal" type="button" class="btn btn-primary">Pilih Diagnosis</a>
                            </div>
                        </div> --}}

                        <div class="form-group2 row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="diagnosis">Diagnosis</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <select class="selectpicker form-control" name="id_diagnosis" data-live-search="true" title="Pilih Diagnosis">
                                    @foreach ($icds as $icd)
                                        <option value="{{ $icd->id_diagnosis }}">{{ $icd->kode }} - {{ $icd->nama_id }}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="form-group row"></div>

                        <div class="form-group2 row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="penunjang">Pemeriksaan Penunjang</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 mb-3 mb-sm-0">
                                {{-- <select class="form-control "id="penunjang" name="penunjang">
                                    <option value="" selected disabled>Pilih satu</option>
                                    @foreach ($labs as $lab)
                                        <option satuan="{{ $lab->satuan }}" value="{{ $lab->id_lab }}">{{ $lab->nama }}</option>
                                    @endforeach
                                </select> --}}
                                <select class="selectpicker form-control "id="penunjang" name="penunjang" data-live-search="true" title="Pilih Pemeriksaan Lab">
                                    @foreach ($labs as $lab)
                                        <option satuan="{{ $lab->satuan }}" value="{{ $lab->id_lab }}">{{ $lab->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <a href="javascript:;" onclick="addpenunjang()" type="button" name="add"
                                    id="add" class="btn btn-success">Tambahkan</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <table id="dynamicTable"></table>
                            </div>
                        </div>
                        <div class="form-group2 row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="reseplist">Resep</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 mb-0 mb-sm-0">
                                {{-- <select class="form-control " name="reseplist" id="reseplist">
                                    <option value="" selected disabled>Pilih satu</option>
                                    @foreach ($obats as $obat)
                                        <option value="{{ $obat->id_obat }}">{{ $obat->nama_obat }} {{ $obat->sediaan }} {{ $obat->dosis }}{{ $obat->satuan }} - Stok: {{ $obat->stok }}</option>
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
                                <table width="100%" id="reseps"></table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <button type="submit" class="btn btn-primary btn-block" name="simpan"
                                    value="simpan_edit">
                                    <i class="fas fa-save fa-fw"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    
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
                    '" class="form-control" readonly></td><td><input type="hidden" name="lab[' + i +
                    '][hasil]" value="0" class="form-control" required></td></td><td><button type="button" class="btn btn-danger remove-pen">Hapus</button></td></tr>'
                );
            }
            ++i;
        };

        function addresep() {
            var res = $("#reseplist option:selected").html();
            var resid = $("#reseplist").val();
            if (resid !== null) {
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

        function getDiagnosis(id_diagnosis, diagnosis){
            document.getElementById("id_diagnosis").value= id_diagnosis;
            document.getElementById("diagnosis").value= diagnosis;
        }

        $(document).on('click', '.remove-pen', function() {
            $(this).parents('tr').remove();
        });

        $(document).on('click', '.remove-res', function() {
            $(this).parents('tr').remove();
        });
    </script>

@endsection
