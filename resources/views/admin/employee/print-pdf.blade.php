<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pegawai</title>
    <link rel="stylesheet" href="{{ $bootstrapPath }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px; /* Ukuran font lebih kecil */
        }
        .table {
            width: 100%; /* Gunakan lebar penuh */
            border-collapse: collapse;
            font-size: 9px;
        }
        .table th {
            background-color:rgb(184, 242, 255);
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 4px;
            text-align: center;
            vertical-align: middle;
        }
        .img-thumbnail {
            width: 40px;
            height: 40px;
            min-width: 40px;
            min-height: 40px;
            max-width: 40px;
            max-height: 40px;
            object-fit: fill;
            border-radius: 5px;
        }
        h2 {
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h2 class="text-center">Data Pegawai</h2>

    <table class="table">
        <thead class="table-dark">
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
                <th>Unit Kerja</th>
                <th>No. HP</th>
                <th>NPWP</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->employee_id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->birth_place }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->birth_date }}</td>
                    <td>{{ $employee->gender == 'male' ? 'L' : 'P' }}</td>
                    <td>{{ $employee->rank?->rank_name ?? '-' }}</td>
                    <td>{{ $employee->echelon?->echelon_name ?? '-' }}</td>
                    <td>{{ $employee->position?->position_description ?? '-' }}</td>
                    <td>{{ $employee->workPlace?->work_place_name ?? '-' }}</td>
                    <td>{{ $employee->religion?->religion_name ?? '-' }}</td>
                    <td>{{ $employee->workUnit?->work_unit_name ?? '-' }}</td>
                    <td>{{ $employee->phone_number }}</td>
                    <td>{{ $employee->npwp_number }}</td>
                    <td>
                        @if($employee->imgBase64)
                            <img src="data:image/jpeg;base64,{{ $employee->imgBase64 }}" width="50">
                        @else
                            Tidak ada foto
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
