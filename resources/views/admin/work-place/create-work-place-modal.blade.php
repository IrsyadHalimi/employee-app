<!-- Modal -->
<div class="modal fade" id="workPlaceCreateModal" tabindex="-1" aria-labelledby="rankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rankModalLabel">Tambah Tempat Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="workPlaceCreateForm">
                        @csrf
                        <div class="mb-3">
                            <label for="workPlaceName" class="form-label">Nama Tempat Tugas</label>
                            <input type="text" class="form-control" id="workPlaceName" name="workPlaceName" >
                        </div>
                        <button type="submit" id="submitCreateWorkPlace" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
