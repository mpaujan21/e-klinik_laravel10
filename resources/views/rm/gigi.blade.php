@extends('master')
@section('content')
    {{-- Odontograma --}}
    <link rel="stylesheet" href="{{ URL::asset('odontograma/css/jquery.svg.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('odontograma/css/odontograma.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('odontograma/css/jquery-ui-1.8.17.custom.css') }}">
    {{-- <link rel="stylesheet" href="{{ URL::asset('odontograma/css/style.css') }}"> --}}

    {{-- Selectpicker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <div class="card shadow mb-4">
        <a href="#odontogram" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
            aria-controls="odontogram">
            <h6 class="m-0 font-weight-bold text-primary">Odontogram</h6>
        </a>
        <div class="collapse show" id="odontogram">
            <div class="card-body">
                <table class="table table-borderless" style="width: 100%">
                    <tbody>
                        <tr>
                            <td align="center">
                                <div id="odontograma"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group row"></div>

                <div class="form-group2 row">
                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <label for="jenis">Nomor Gigi</label>
                    </div>

                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <label for="jenis">Kondisi Gigi</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <select id="elemen_gigi" class="selectpicker form-control" data-live-search="true" data-dropup-auto="false">
                            @php
                                for ($i = 11; $i < 19; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . '</option>';
                                }
                                for ($i = 21; $i < 29; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . '</option>';
                                }
                                for ($i = 31; $i < 39; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . '</option>';
                                }
                                for ($i = 41; $i < 49; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . '</option>';
                                }
                                for ($i = 51; $i < 56; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . '</option>';
                                }
                                for ($i = 61; $i < 66; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . '</option>';
                                }
                                for ($i = 71; $i < 76; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . '</option>';
                                }
                                for ($i = 81; $i < 86; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . '</option>';
                                }
                            @endphp
                        </select>
                    </div>

                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <select name="pemeriksaan" id="kondisi_gigi" class="selectpicker form-control" data-live-search="true" data-dropup-auto="false">
                            <option value="" selected disabled>Pilih satu</option>
                            <option value="sou">sound</option>
                            <option value="mis">missing</option>
                            <option value="amf">amalgam filling</option>
                            <option value="gif">glass ionomer filling</option>
                            <option value="fis">fissure sealant</option>
                            <option value="car">caries</option>
                            <option value="nvt">non-vital tooth</option>
                            <option value="cfr">crown fractured</option>
                            <option value="amf">amalgam filling</option>
                            <option value="poc">porcelain crown</option>
                            <option value="fmc">full metal crown</option>
                            <option value="abu">abutment</option>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <button type="button" id="updateSVG" class="btn btn-success close-btn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="pemeriksaan_gigis" value="{{ $pemeriksaan_gigis }}">
    <input type="hidden" id="elemen_gigis" value="{{ $elemen_gigis }}">

    <script src="{{ URL::asset('odontograma/js/modernizr-2.0.6.min.js') }}"></script>
    <script defer src="{{ URL::asset('odontograma/js/jquery-1.7.1.min.js') }}"></script>
    <script defer src="{{ URL::asset('odontograma/js/plugins.js') }}"></script>
    <script defer src="{{ URL::asset('odontograma/js/jquery-ui-1.8.17.custom.min.js') }}"></script>
    <script defer src="{{ URL::asset('odontograma/js/jquery.tmpl.j') }}s"></script>
    <script defer src="{{ URL::asset('odontograma/js/knockout-2.0.0.js') }}"></script>
    <script defer src="{{ URL::asset('odontograma/js/jquery.svg.min.js') }}"></script>
    <script defer src="{{ URL::asset('odontograma/js/jquery.svggraph.min.js') }}"></script>
    <script defer src="{{ URL::asset('odontograma/js/odontograma.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
