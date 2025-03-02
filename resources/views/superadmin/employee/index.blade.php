@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
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
                                    <th>Jabatan</th>
                                    <th>Tempat Tugas</th>
                                    <th>Agama</th>
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
                url: "{{ route('superadmin.employee.data') }}",
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
                { data: 'rank_id', name: 'rank_id' },
                { data: 'echelon_id', name: 'echelon_id' },
                { data: 'position_id', name: 'position_id' },
                { data: 'work_place_id', name: 'work_place_id' },
                { data: 'religion_id', name: 'religion_id' },
                { data: 'work_unit_id', name: 'work_unit_id' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'npwp_number', name: 'npwp_number' }
            ]
        });

        $('#workUnitFilter').change(function () {
            table.ajax.reload(); 
        });
    });
</script>
@endsection
