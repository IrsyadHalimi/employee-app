<!-- Modal -->
<div class="modal fade" id="positionCreateModal" tabindex="-1" aria-labelledby="positionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="positionModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="positionCreateForm">
                        @csrf
                        <div class="mb-3">
                            <label for="positionDescription" class="form-label">Nama Golongan</label>
                            <input type="text" class="form-control" id="positionDescription" name="positionDescription" >
                        </div>
                        <button type="submit" id="submitCreatePosition" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
