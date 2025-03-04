<!-- Modal -->
<div class="modal fade" id="religionCreateModal" tabindex="-1" aria-labelledby="religionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="religionModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="religionCreateForm">
                        @csrf
                        <div class="mb-3">
                            <label for="religionName" class="form-label">Nama Golongan</label>
                            <input type="text" class="form-control" id="religionName" name="religionName" >
                        </div>
                        <button type="submit" id="submitCreateReligion" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
