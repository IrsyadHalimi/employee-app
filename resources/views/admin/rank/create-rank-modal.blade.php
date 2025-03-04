<!-- Modal -->
<div class="modal fade" id="rankCreateModal" tabindex="-1" aria-labelledby="rankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rankModalLabel">Tambah Golongan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rankCreateForm">
                        @csrf
                        <div class="mb-3">
                            <label for="rankName" class="form-label">Nama Golongan</label>
                            <input type="text" class="form-control" id="rankName" name="rankName" >
                        </div>
                        <button type="submit" id="submitCreateRank" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
