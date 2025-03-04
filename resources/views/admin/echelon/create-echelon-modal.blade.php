<!-- Modal -->
<div class="modal fade" id="echelonCreateModal" tabindex="-1" aria-labelledby="echelonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="echelonModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="echelonCreateForm">
                        @csrf
                        <div class="mb-3">
                            <label for="echelonName" class="form-label">Nama Golongan</label>
                            <input type="text" class="form-control" id="echelonName" name="echelonName" >
                        </div>
                        <button type="submit" id="submitCreateEchelon" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
