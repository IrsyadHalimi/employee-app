<!-- Modal -->
<div class="modal fade" id="echelonEditModal" tabindex="-1" aria-labelledby="echelonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="echelonModalLabel">Edit Eselon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="echelonEditForm">
                        @csrf
                        <input type="text" name="echelonId" id="echelonId" hidden>
                        <div class="mb-3">
                            <label for="newEchelonName" class="form-label">Nama Golongan</label>
                            <input type="text" class="form-control" id="newEchelonName" name="newEchelonName" >
                        </div>
                        <button type="submit" id="submitEditEchelon" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
