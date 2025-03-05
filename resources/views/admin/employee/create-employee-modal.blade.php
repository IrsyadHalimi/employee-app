<!-- Modal -->
<div class="modal fade" id="employeeCreateModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="employeeCreateForm">
                        @csrf
                        <div class="mb-3">
                            <label for="employeeId" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="employeeId" name="employeeId" >
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" >
                        </div>

                        <div class="mb-3">
                            <label for="birthPlace" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="birthPlace" name="birthPlace" >
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" >
                        </div>

                        <div class="mb-3">
                            <label for="birthDate" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="birthDate" name="birthDate" >
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" >
                                    <label for="male">Laki-laki</label>
                                </div>
                                <div class="col-sm-6">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" >
                                <label for="female">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="rankId" class="form-label">Golongan</label>
                            <select class="form-select" id="rankId" name="rankId" >
                                <option value="">Pilih</option>
                                @foreach($ranks as $rank)
                                    <option value="{{ $rank->id }}">{{ $rank->rank_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="echelonId" class="form-label">Eselon</label>
                            <select class="form-select" id="echelonId" name="echelonId" >
                                <option value="">Pilih</option>
                                @foreach($echelons as $echelon)
                                    <option value="{{ $echelon->id }}">{{ $echelon->echelon_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="positionId" class="form-label">Jabatan</label>
                            <select class="form-select" id="positionId" name="positionId" >
                                <option value="">Pilih</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->position_description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="religionId" class="form-label">Agama</label>
                            <select class="form-select" id="religionId" name="religionId" >
                                <option value="">Pilih</option>
                                @foreach($religions as $religion)
                                    <option value="{{ $religion->id }}">{{ $religion->religion_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="workPlaceId" class="form-label">Tempat Tugas</label>
                            <select class="form-select" id="workPlaceId" name="workPlaceId" >
                                <option value="">Pilih</option>
                                @foreach($workPlaces as $workPlace)
                                    <option value="{{ $workPlace->id }}">{{ $workPlace->work_place_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="workUnitId" class="form-label">Unit Kerja</label>
                            <select class="form-select" id="workUnitId" name="workUnitId" >
                                <option value="">Pilih</option>
                                @foreach($workUnits as $workUnit)
                                    <option value="{{ $workUnit->id }}">{{ $workUnit->work_unit_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">No. HP</label>
                            <input type="number" class="form-control" id="phoneNumber" name="phoneNumber" >
                        </div>

                        <div class="mb-3">
                            <label for="npwpNumber" class="form-label">NPWP</label>
                            <input type="number" class="form-control" id="npwpNumber" name="npwpNumber" >
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">Upload Foto</label>
                            <input type="file" class="form-control" name="img" id="img" accept="image/*">
                        </div>

                        <button type="submit" id="submitCreateEmployee" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
