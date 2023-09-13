@extends('master')
@section('judul_halaman')
    Hasil Lab
@endsection
@section('deskripsi_halaman')
    {{-- Upload excel stok obat --}}
@section('content')

    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#ListRM" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
            aria-controls="ListRM">
            <h6 class="m-0 font-weight-bold text-primary">Input Hasil Lab</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="ListRM" style="">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="pasien" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No RM</th>
                                <th>Nama Pasien</th>
                                <th width="150px">Tanggal Periksa</th>
                                <th width="700px">Lab</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rms as $rm)
                                <tr>
                                    <td>{{ str_pad($rm->id_rm, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ str_pad($rm->pasien->user->nama, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ format_date($rm->created_at) }}</td>
                                    <td>
                                        @if ($rm->id_labs != null)
                                            @for ($i = 0; $i < sizeof($lab = encode($rm->id_labs)); $i++)
                                                @if ($page_hasil == 1 AND $has = encode($rm->hasil_labs))
                                                    <li>{{ get_value('labs', $lab[$i], 'nama', 'id_lab') }} : {{ $has[$i] }}
                                                        {{ get_value('labs', $lab[$i], 'satuan', 'id_lab') }}</li>
                                                @else
                                                    <li>{{ get_value('labs', $lab[$i], 'nama', 'id_lab') }}</li>
                                                @endif
                                            @endfor
                                        @endif
                                    </td>
                                    <td width="150px">
                                        <a href="{{ route('lab.input', $rm->id_rm) }}"
                                            class="btn btn-primary btn-sm btn-icon-split">
                                            <span class="icon">
                                                <i style="padding-top:4px"class="fas fa-file"></i>
                                            </span>
                                            @if ($page_hasil == 0)
                                                <span class="text">Input hasil lab</span>
                                            @else
                                                <span class="text">Edit hasil lab</span>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#pasien').DataTable({
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ]
            })
        });
    </script>

@endsection
