<!-- Modal -->
<div class="modal fade" id="workUnitEditModal" tabindex="-1" aria-labelledby="rankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rankModalLabel">Edit Unit Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="workUnitEditForm">
                        @csrf
                        <input type="text" name="workUnitId" id="workUnitId" hidden>
                        <div class="mb-3">
                            <label for="newWorkUnitName" class="form-label">Nama Unit Kerja</label>
                            <input type="text" class="form-control" id="newWorkUnitName" name="newWorkUnitName" >
                        </div>
                        <button type="submit" id="submitEditWorkUnit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
