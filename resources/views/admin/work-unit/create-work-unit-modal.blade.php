<!-- Modal -->
<div class="modal fade" id="workUnitCreateModal" tabindex="-1" aria-labelledby="rankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rankModalLabel">Tambah Unit Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="workUnitCreateForm">
                        @csrf
                        <div class="mb-3">
                            <label for="workUnitName" class="form-label">Nama Unit Kerja</label>
                            <input type="text" class="form-control" id="workUnitName" name="workUnitName" >
                        </div>
                        <button type="submit" id="submitCreateWorkUnit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
