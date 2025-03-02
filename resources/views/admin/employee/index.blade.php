@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#employeeCreateModal">
                        Tambah Pegawai
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
    $(document).ready(function () {
        var table = $('#employeeTable').DataTable({
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
                { data: 'work_unit.work_unit_name', name: 'work_unit.work_unit_name' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'npwp_number', name: 'npwp_number' },
            ]
        });

        $('#workUnitFilter').change(function () {
            table.ajax.reload(); 
        });

        $('#employeeCreateForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var submitButton = $('#submitCreateEmployee');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.employee.store') }}",
                type: "POST",
                data: formData,
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
    });

    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.editButton').forEach(button => {
        button.addEventListener('click', function() {
            const data = {
                employee_id: atob(this.dataset.employee_id),
                name: atob(this.dataset.name),
                birth_place: atob(this.dataset.birth_place),
                address: atob(this.dataset.address),
                birth_date: atob(this.dataset.birth_date),
                gender: atob(this.dataset.gender),
                echelon_id: atob(this.dataset.echelon_id),
                position_id: atob(this.dataset.position_id),
                work_place_id: atob(this.dataset.work_place_id),
                religion_id: atob(this.dataset.religion_id),
                work_unit_id: atob(this.dataset.work_unit_id),
                phone_number: atob(this.dataset.phone_number),
                npwp_number: atob(this.dataset.npwp_number),
            };

            editEmployee(data);
        });
    });
});

function editEmployee(data) {
    // Logika untuk menampilkan data di dalam modal
    console.log(data);
    // ...
    // Contoh untuk memasukkan data ke dalam modal.
    document.getElementById('editEmployeeId').value = data.employee_id;
    document.getElementById('editName').value = data.name;
    // ... dan seterusnya
}
</script>
@endsection
