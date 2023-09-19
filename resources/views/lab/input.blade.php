@extends('master')
@section('judul_halaman')
    Input Hasil Lab
@endsection
{{-- @section('deskripsi_halaman')
    Upload excel stok obat
@endsection --}}
@section('content')
    @include('layouts.identitas')

    @foreach ($datas as $data)
        <div class="card shadow mb-4">
            <a href="#tambahrm" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
                aria-controls="tambahrm">
                <h6 class="m-0 font-weight-bold text-primary">Input Hasil Lab</h6>
            </a>
            <div class="collapse show" id="tambahrm">
                <div class="card-body">
                    <form class="user" action="{{ route('lab.simpan') }}" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" name="idpasien" value="{{ $data->id_pasien }}">
                        <input type="hidden" name="id" value="{{ $data->id_rm }}">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="penunjang">Pemeriksaan Penunjang</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select class="selectpicker form-control "id="penunjang" name="penunjang" data-live-search="true" title="Pilih Pemeriksaan Lab">
                                    @foreach ($labs as $lab)
                                        <option satuan="{{ $lab->satuan }}" value="{{ $lab->id_lab }}">{{ $lab->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <a href="javascript:;" onclick="addpenunjang()" type="button" name="add" id="add"
                                    class="btn btn-success">Tambahkan</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <table id="dynamicTable" width="75%">
                                    @if ($data->id_labs != null)
                                        @for ($i = 0; $i < $num['lab']; $i++)
                                            <tr>
                                                <td><input type="hidden" name="lab[{{ $i }}][id]"
                                                        value="{{ array_keys($data->labhasil)[$i] }}" class="form-control"
                                                        readonly></td>
                                                <td width="30%"><input type="text"
                                                        name="lab[{{ $i }}][nama]"
                                                        value="{{ get_value('labs', array_keys($data->labhasil)[$i], 'nama', 'id_lab') }}"
                                                        class="form-control" readonly></td>
                                                <td width="10%"><input type="text"
                                                        name="lab[{{ $i }}][hasil]"
                                                        value="{{ $data->labhasil[array_keys($data->labhasil)[$i]] }}"
                                                        placeholder="Hasil" class="form-control" required>
                                                <td width=10%"><input class="form-control"
                                                        value='{{ get_value('labs', array_keys($data->labhasil)[$i], 'satuan', 'id_lab') }}'
                                                        readonly></td>
                                                </td>
                                                <td><button type="button" class="btn btn-danger remove-pen">Hapus</button>
                                                </td>
                                            </tr>
                                        @endfor
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <button type="submit" class="btn btn-primary btn-block" name="simpan" value="simpan_edit">
                                    <i class="fas fa-save fa-fw"></i> Simpan
                                </button>
                            </div>
                    </form>
    @endforeach
    </div>
    </div>

    </div>
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
        var i = $("#penunjang").attr('num');
        var a = $("#reseplist").attr('num');

        function addpenunjang() {


            var pen = $("#penunjang option:selected").html();
            var penid = $("#penunjang").val();
            var satuan = $("#penunjang option:selected").attr('satuan');
            if (penid !== null) {
                //code
                $("#dynamicTable").append('<tr><td><input type="hidden" name="lab[' + i + '][id]" value="' + penid +
                    '" class="form-control" readonly></td><td><input type="text" name="lab[' + i + '][nama]" value="' +
                    pen + '" class="form-control" readonly></td><td><input type="text" name="lab[' + i +
                    '][hasil]" placeholder="Hasil" class="form-control" required><td width=20%"><input class="form-control" value=' +
                    satuan +
                    ' readonly></td></td><td><button type="button" class="btn btn-danger remove-pen">Hapus</button></td></tr>'
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
                    '" class="form-control" readonly></td><td><input type="text" name="resep[' + a +
                    '][nama]" value="' + res +
                    '" class="form-control" readonly></td><td><input type="text" name="resep[' + a +
                    '][jumlah]" placeholder="Jumlah" class="form-control" required><td><input type="text" name="resep[' +
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
    </script>
@endsection
