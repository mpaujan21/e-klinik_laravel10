<!-- Modal List Diagnosis -->
<div wire:ignore.self class="modal fade" id="DiagnosisModal" tabindex="-1" role="dialog" aria-labelledby="DiagnosisModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="DiagnosisModalLabel">Pilih Diagnosis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="table-responsive" style="padding-left: 50px; padding-right: 50px; padding-top: 50px; padding-bottom: 50px;">
                <table class="table table-bordered table-sm table-striped" id="pasien" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Diagnosis</th>
                            <th>Nama Diagnosis</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($icds as $icd)
                            <tr>
                                <td width="30%">{{ $icd->kode }}</td>
                                <td>{{ $icd->nama_id }}</td>
                                <td width="10%">
                                    <button onclick="getDiagnosis('{{ $icd->id_diagnosis }}', '{{ $icd->kode }} - {{ $icd->nama_id }}')" class="btn btn-primary btn-sm" data-dismiss="modal">Pilih</button>
                                </td>
                            </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>