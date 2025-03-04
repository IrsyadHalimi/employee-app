<!-- Modal -->
<div class="modal fade" id="rankEditModal" tabindex="-1" aria-labelledby="rankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rankModalLabel">Edit Golongan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rankEditForm">
                        @csrf
                        <input type="text" name="rankId" id="rankId" hidden>
                        <div class="mb-3">
                            <label for="newRankName" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="newRankName" name="newRankName" >
                        </div>
                        <button type="submit" id="submitEditRank" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
