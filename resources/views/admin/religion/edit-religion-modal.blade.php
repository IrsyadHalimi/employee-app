<!-- Modal -->
<div class="modal fade" id="religionEditModal" tabindex="-1" aria-labelledby="religionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="religionModalLabel">Edit Eselon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="religionEditForm">
                        @csrf
                        <input type="text" name="religionId" id="religionId" hidden>
                        <div class="mb-3">
                            <label for="newReligionName" class="form-label">Nama Golongan</label>
                            <input type="text" class="form-control" id="newReligionName" name="newReligionName" >
                        </div>
                        <button type="submit" id="submitEditReligion" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
