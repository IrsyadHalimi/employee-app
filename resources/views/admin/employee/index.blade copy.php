@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pegawai') }}</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#employeeCreateModal">
                        Tambah Pegawai
                    </button>
                    <button type="button" class="printButton btn btn-warning mb-3">
                        Cetak Data
                    </button>
                    <div class="mb-3">
                        <label for="workUnitFilter" class="form-label">Pilih Unit Kerja</label>
                        <select id="workUnitFilter" class="form-select">
                            <option value="">Semua Unit Kerja</option>
                            @foreach ($workUnits as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->work_unit_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="table-responsive">
                        <table id="employeeTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Lahir</th>
                                    <th>L/P</th>
                                    <th>Gol</th>
                                    <th>Eselon</th>
                                    <th>Jabatan</th>
                                    <th>Tempat Tugas</th>
                                    <th>Agama</th>
                                    <th>Aksi</th>
                                    <th>Unit Kerja</th>
                                    <th>No. HP</th>
                                    <th>NPWP</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.employee.create-employee-modal')
@include('admin.employee.edit-employee-modal')
@endsection
@section('scripts')
<script>
    var table;

    $(document).ready(function () {
        table = $('#employeeTable').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.employee.data') }}",
                data: function (d) {
                    d.workUnit = $('#workUnitFilter').val();
                }
            },
            columns: [
                {
                    className: 'dt-control',
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'employee_id', name: 'employee_id' },
                { data: 'name', name: 'name' },
                { data: 'birth_place', name: 'birth_place' },
                { data: 'address', name: 'address' },
                { data: 'birth_date', name: 'birth_date' },
                { data: 'gender', name: 'gender' },
                { data: 'rank.rank_name', name: 'rank.rank_name' },
                { data: 'echelon.echelon_name', name: 'echelon.echelon_name' },
                { data: 'position.position_description', name: 'position.position_description' },
                { data: 'workPlace.work_place_name', name: 'workPlace.work_place_name' },
                { data: 'religion.religion_name', name: 'religion.religion_name' },
                { data: 'action', name: 'action' },
                { data: 'workUnit.work_unit_name', name: 'workUnit.work_unit_name' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'npwp_number', name: 'npwp_number' },
                {
                    data: 'img',
                    name: 'img',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        if (data) {
                            return `<img src="/storage/profile/${data}" class="img-thumbnail" width="100" height="100">`;
                        }
                        return `<img src="{{ asset('profile/default.jpg') }}" class="img-thumbnail" width="100" height="100">`;
                    }
                },
            ]
        });

        $('#workUnitFilter').change(function () {
            table.ajax.reload();
        });

        $('#employeeCreateForm').submit(function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            var submitButton = $('#submitCreateEmployee');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.employee.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#employeeCreateModal').modal('hide');
                            $('#employeeCreateForm')[0].reset();
                            table.ajax.reload();
                        })
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function (key, value) {
                        errorMessage += value + '\n';
                    });
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                },
                complete: function () {
                    table.processing(false);
                    submitButton.prop('disabled', false).html('Simpan');
                }
            });
        });

        $(document).on('click', '.editButton', function() {
            var employeeId = atob($(this).data('employee_id'));
            var name = atob($(this).data('name'));
            var birthPlace = atob($(this).data('birth_place'));
            var address = atob($(this).data('address'));
            var birthDate = atob($(this).data('birth_date'));
            var gender = atob($(this).data('gender'));
            var echelonId = atob($(this).data('echelon_id'));
            var positionId = atob($(this).data('position_id'));
            var workPlaceId = atob($(this).data('work_place_id'));
            var religionId = atob($(this).data('religion_id'));
            var workUnitId = atob($(this).data('work_unit_id'));
            var phoneNumber = atob($(this).data('phone_number'));
            var npwpNumber = atob($(this).data('npwp_number'));

            $('#employeeEditModal #employeeId').val(employeeId);
            $('#employeeEditModal #newEmployeeId').val(employeeId);
            $('#employeeEditModal #name').val(name);
            $('#employeeEditModal #birthPlace').val(birthPlace);
            $('#employeeEditModal #address').val(address);
            $('#employeeEditModal #birthDate').val(birthDate);
            if (gender === 'male') {
                $('#employeeEditModal #male').prop('checked', true);
            } else if (gender === 'female') {
                $('#employeeEditModal #female').prop('checked', true);
            }
            $('#employeeEditModal #echelonId').val(echelonId);
            $('#employeeEditModal #positionId').val(positionId);
            $('#employeeEditModal #workPlaceId').val(workPlaceId);
            $('#employeeEditModal #religionId').val(religionId);
            $('#employeeEditModal #workUnitId').val(workUnitId);
            $('#employeeEditModal #phoneNumber').val(phoneNumber);
            $('#employeeEditModal #npwpNumber').val(npwpNumber);

            $('#employeeEditModal').modal('show');
        });

        $('#employeeEditForm').submit(function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            var submitButton = $('#submitEditEmployee');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.employee.update') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#employeeCreateModal').modal('hide');
                            $('#employeeCreateForm')[0].reset();
                            table.ajax.reload();
                        });
                        $('#employeeEditModal').modal('hide');
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function (key, value) {
                        errorMessage += value + '\n';
                    });
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                },
                complete: function () {
                    table.processing(false);
                    submitButton.prop('disabled', false).html('Simpan');
                }
            });
        });

        $(document).on('click', '.printButton', function() {
            let url = '{{ route('admin.employee.print-pdf') }}';
            window.location.href = url;
        });
    });

    function deleteEmployee(employeeId) {
        if(employeeId != "") {
            Swal.fire({
            title: 'Anda yakin ingin menghapus?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true,
            reverseButtons: false,
            focusCancel: false,
        }).then((result) => {
            if (result.isConfirmed) {
                table.processing(true);
                let token = document.getElementsByName('_token')[0].value.trim();
                let url = '{{ route('admin.employee.destroy') }}';
                $.ajax({
                    url : url,
                    type : 'DELETE',
                    dataType : 'json',
                    data : {
                        _token : token,
                        employeeId: employeeId
                    },
                    success : function(response) {
                        table.ajax.reload();
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error : function(response) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: response.message,
                            icon: 'error',
                        });
                    },
                    complete: function() {
                        table.processing(false);
                        table.ajax.reload();
                    }
                });
                table.processing(false);
            }
        });
        } else {
            Swal.fire({
                title: 'Gagal!',
                text: response.message,
                icon: 'error',
            });
        }
    }
</script>
@endsection
