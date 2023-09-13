<div class="card shadow mb-4">
    <a href="#Identitas" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="Identitas">
        <h6 class="m-0 font-weight-bold text-primary">Identitas Pasien</h6>
    </a>
    <div class="collapse show" id="Identitas">
        <div class="card-body">
            @foreach ($idens as $iden)
                <form class="user" action="">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control " name="nama_lengkap"
                                value="{{ $iden->user->nama }}" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="nik">NIK :</label>
                            <input type="text" class="form-control " name="nik"
                                value="{{ $iden->nik }}" readonly>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
</div>