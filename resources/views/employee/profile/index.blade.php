@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Data Pegawai') }}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <x-tables.table-data name="employeeProfileTable" :options="[
                            'No',
                            'NIP',
                            'Nama',
                            'Tempat Lahir',
                            'Alamat',
                            'Tanggal Lahir',
                            'L/P',
                            'Gol',
                            'Eselon',
                            'Jabatan',
                            'Tempat Tugas',
                            'Agama',
                            'Unit Kerja',
                            'No. HP',
                            'NPWP',
                            'Foto'
                        ]" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    var table;

    $(document).ready(function () {
        table = $('#employeeProfileTable').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('employee.profile.data') }}",
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
    });
</script>
@endsection
