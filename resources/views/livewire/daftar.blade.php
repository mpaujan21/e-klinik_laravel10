<div class="card-body">
    <div class="card-body">
        <form class="user" action="{{ route('pendaftaran.input') }}" method="post">
            {{ csrf_field() }}
            
            {{-- <input wire:model="id_jadwal" type="hidden" class="form-control" name="id_jadwal" readonly>
            <input wire:model="kuota" type="hidden" class="form-control" name="kuota" readonly>
            <input wire:model="id_pasien" type="hidden" class="form-control" name="id_pasien" readonly> --}}
            <input wire:model="id_jadwal" type="hidden" class="form-control" readonly>
            <input wire:model="kuota" type="hidden" class="form-control" readonly>
            <input wire:model="id_pasien" type="hidden" class="form-control" readonly>
            <div class="form-group">
                <label for="poli">Jenis Poli</label>
                {{-- <select wire:model="idPoli" class="form-control" name="idPoli" placeholder="Poli"> --}}
                <select wire:model="idPoli" class="form-control" placeholder="Poli">
                    <option value="">-- Pilih Poli --</option>
                    <option value=1>Umum</option>
                    <option value=2>Gigi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                {{-- <input wire:model="tanggalKunjungan" type="date" class="form-control" name="tanggalKunjungan" placeholder="" min="<?= date('Y-m-d'); ?>"> --}}
                <input wire:model="tanggalKunjungan" type="date" class="form-control" placeholder="" min="<?= date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <p style="color:red;">{{ $message }}</p>
            </div>
            <div class="form-group">
                <label for="kuota">Nama Dokter</label>
                {{-- <input wire:model="dokter" type="text" class="form-control" name="dokter" readonly> --}}
                <input wire:model="dokter" type="text" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="sisa_kuota">Sisa Kuota Kunjungan</label>
                {{-- <input wire:model="sisa_kuota" type="number" class="form-control" name="sisa_kuota" readonly> --}}
                <input wire:model="sisa_kuota" type="number" class="form-control" readonly>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <button type="submit" class="btn btn-primary btn-block" name="simpan">
                        <i class="fas fa-save fa-fw" ></i> Daftar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>