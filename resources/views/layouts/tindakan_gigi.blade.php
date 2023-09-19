<!-- Modal List Diagnosis -->
<div wire:ignore.self class="modal fade" id="GigiModal" tabindex="-1" role="dialog" aria-labelledby="GigiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered" style="max-width: 20%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="GigiModalLabel">Pilih Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>

            <div class="form-group row">
            </div>
            <div class="form-group row" style="margin-left: 20px;">
                <label for="gigi_18_0">
                    <input type="checkbox" value="sou" name="gigi_18" id="gigi_18_0">
                    <span class="checkable">
                        <img src="{{ URL::asset('odontogram/img/sano.png') }}" alt="tooth" width="30"
                            height="30">
                        Sehat
                    </span><br>
                </label>
            </div>
            <div class="form-group row" style="margin-left: 20px;">
                <label for="gigi_18_1">
                    <input type="checkbox" value="c1" name="gigi_18" id="gigi_18_1">
                    <span class="checkable">
                        <img src="{{ URL::asset('odontogram/img/c1.png') }}" alt="tooth" width="30"
                            height="30">
                        Caries
                    </span><br>
                </label>
            </div>
            <div class="form-group row" style="margin-left: 20px;">
                <label for="gigi_18_2">
                    <input type="checkbox" value="c2" name="gigi_18" id="gigi_18_2">
                    <span class="checkable">
                        <img src="{{ URL::asset('odontogram/img/c2.png') }}" alt="tooth" width="30"
                            height="30">
                        Caries
                    </span><br>
                </label>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-secondary close-btn" onclick=addImage()>Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function addImage() {
        $("gigi_18").append('<img class="inner_tooth" style="z-index : 1;" width="50" height="50" src="{{ URL::asset("odontogram/img/c1.png") }}">');
    }
</script>
