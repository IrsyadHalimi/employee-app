<!-- Modal -->
<div class="modal fade" id="positionEditModal" tabindex="-1" aria-labelledby="positionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="positionModalLabel">Edit Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="positionEditForm">
                        @csrf
                        <input type="text" name="positionId" id="positionId" hidden>
                        <div class="mb-3">
                            <label for="newPositionDescription" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" id="newPositionDescription" name="newPositionDescription" >
                        </div>
                        <button type="submit" id="submitEditPosition" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
