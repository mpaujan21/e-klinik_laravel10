<div class="card shadow mb-4">
    <a href="#PilihPasien" class="d-block card-header py-3 {{ $cont['col'] }}" data-toggle="collapse" role="button"
        aria-expanded="{{ $cont['aria'] }}" aria-controls="PilihPasien">
        <h6 class="m-0 font-weight-bold text-primary">Pilih pasien</h6>
    </a>
    <div class="collapse {{ $cont['show'] }}" id="PilihPasien" style="">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-striped" id="pasien" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id Pasien</th>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasiens as $pasien)
                            <tr>
                                <td>{{ str_pad($pasien->id_pasien, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $pasien->user->nama }}</td>
                                <td>{{ $pasien->nik }}</td>
                                <td width="120px">
                                    @if ($input_page == true)
                                        <a href="{{ route('rm.input.id', $pasien->id_pasien) }}" class="btn btn-primary btn-sm btn-icon-split">
                                    @else
                                        <a href="{{ route('rm.riwayat.id', $pasien->id_pasien) }}" class="btn btn-primary btn-sm btn-icon-split">
                                    @endif
                                        <span class="icon text-white-50">
                                            <i style="padding-top:4px"class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Pilih</span>
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