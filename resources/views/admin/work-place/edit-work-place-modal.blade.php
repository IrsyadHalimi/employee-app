<!-- Modal -->
<div class="modal fade" id="workPlaceEditModal" tabindex="-1" aria-labelledby="rankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rankModalLabel">Edit Tempat Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="workPlaceEditForm">
                        @csrf
                        <input type="text" name="workPlaceId" id="workPlaceId" hidden>
                        <div class="mb-3">
                            <label for="newWorkPlaceName" class="form-label">Nama Tempat Tugas</label>
                            <input type="text" class="form-control" id="newWorkPlaceName" name="newWorkPlaceName" >
                        </div>
                        <button type="submit" id="submitEditWorkPlace" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
