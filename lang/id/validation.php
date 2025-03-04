<?php

return [
    'required' => 'Kolom :attribute wajib diisi.',
    'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
    'min' => [
        'string' => 'Kolom :attribute harus memiliki minimal :min karakter.',
    ],
    'max' => [
        'string' => 'Kolom :attribute harus memiliki maksimal :max karakter.',
    ],
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'unique' => ':Attribute sudah digunakan.',
    'custom' => [
        'password' => [
            'min' => 'Kata sandi minimal :min karakter.',
        ],
        'employeeId' => [
            'required' => 'NIP wajib diisi.',
            'unique' => 'NIP sudah terdaftar.',
            'max' => 'NIP tidak boleh lebih dari 11 karakter.',
        ],
        'name' => [
            'required' => 'Nama wajib diisi.',
            'string' => 'Nama harus berupa teks.',
            'max' => 'Nama tidak boleh lebih dari 50 karakter.',
        ],
        'birthPlace' => [
            'required' => 'Tempat lahir wajib diisi.',
            'string' => 'Tempat lahir harus berupa teks.',
            'max' => 'Tempat lahir tidak boleh lebih dari 50 karakter.',
        ],
        'address' => [
            'nullable' => 'Alamat boleh dikosongkan.',
            'string' => 'Alamat harus berupa teks.',
            'max' => 'Alamat tidak boleh lebih dari 255 karakter.',
        ],
        'birthDate' => [
            'required' => 'Tanggal lahir wajib diisi.',
            'date' => 'Tanggal lahir harus berupa tanggal yang valid.',
        ],
        'gender' => [
            'required' => 'Jenis kelamin wajib diisi.',
            'in' => 'Jenis kelamin harus "male" atau "female".',
        ],
        'religionId' => [
            'required' => 'Agama wajib diisi.',
            'exists' => 'Agama yang dipilih tidak valid.',
        ],
        'rankId' => [
            'nullable' => 'Pangkat boleh dikosongkan.',
            'exists' => 'Pangkat yang dipilih tidak valid.',
        ],
        'echelonId' => [
            'nullable' => 'Eselon boleh dikosongkan.',
            'exists' => 'Eselon yang dipilih tidak valid.',
        ],
        'positionId' => [
            'nullable' => 'Jabatan boleh dikosongkan.',
            'exists' => 'Jabatan yang dipilih tidak valid.',
        ],
        'workPlaceId' => [
            'nullable' => 'Tempat kerja boleh dikosongkan.',
            'exists' => 'Tempat kerja yang dipilih tidak valid.',
        ],
        'workUnitId' => [
            'nullable' => 'Unit kerja boleh dikosongkan.',
            'exists' => 'Unit kerja yang dipilih tidak valid.',
        ],
        'phoneNumber' => [
            'nullable' => 'Nomor telepon boleh dikosongkan.',
            'string' => 'Nomor telepon harus berupa teks.',
            'max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',
        ],
        'npwpNumber' => [
            'nullable' => 'Nomor NPWP boleh dikosongkan.',
            'string' => 'Nomor NPWP harus berupa teks.',
            'max' => 'Nomor NPWP tidak boleh lebih dari 20 karakter.',
        ],
        'echelonName' => [
            'required' => 'Nama Eselon wajib diisi.',
            'string' => 'Nama Eselon harus berupa teks.',
            'unique' => 'Nama Eselon sudah terdaftar.',
            'max' => 'Nama Eselon tidak boleh lebih dari 10 karakter.',
        ],
        'newEchelonName' => [
            'required' => 'Nama Eselon wajib diisi.',
            'string' => 'Nama Eselon harus berupa teks.',
            'unique' => 'Nama Eselon sudah terdaftar.',
            'max' => 'Nama Eselon tidak boleh lebih dari 10 karakter.',
        ],
        'rankName' => [
            'required' => 'Nama Golongan wajib diisi.',
            'string' => 'Nama Golongan harus berupa teks.',
            'unique' => 'Nama Golongan sudah terdaftar.',
            'max' => 'Nama Golongan tidak boleh lebih dari 10 karakter.',
        ],
        'newRankName' => [
            'required' => 'Nama Golongan wajib diisi.',
            'string' => 'Nama Golongan harus berupa teks.',
            'unique' => 'Nama Golongan sudah terdaftar.',
            'max' => 'Nama Golongan tidak boleh lebih dari 10 karakter.',
        ],
        'religionName' => [
            'required' => 'Nama Agama wajib diisi.',
            'string' => 'Nama Agama harus berupa teks.',
            'unique' => 'Nama Agama sudah terdaftar.',
            'max' => 'Nama Agama tidak boleh lebih dari 50 karakter.',
        ],
        'newReligionName' => [
            'required' => 'Nama Agama wajib diisi.',
            'string' => 'Nama Agama harus berupa teks.',
            'unique' => 'Nama Agama sudah terdaftar.',
            'max' => 'Nama Agama tidak boleh lebih dari 10 karakter.',
        ],
        'workPlaceName' => [
            'required' => 'Nama Tempat Kerja wajib diisi.',
            'string' => 'Nama Tempat Kerja harus berupa teks.',
            'unique' => 'Nama Tempat Kerja sudah terdaftar.',
            'max' => 'Nama Tempat Kerja tidak boleh lebih dari 10 karakter.',
        ],
        'newWorkPlaceName' => [
            'required' => 'Nama Tempat Kerja wajib diisi.',
            'string' => 'Nama Tempat Kerja harus berupa teks.',
            'unique' => 'Nama Tempat Kerja sudah terdaftar.',
            'max' => 'Nama Tempat Kerja tidak boleh lebih dari 10 karakter.',
        ],
        'workUnitName' => [
            'required' => 'Nama Unit Kerja wajib diisi.',
            'string' => 'Nama Unit Kerja harus berupa teks.',
            'unique' => 'Nama Unit Kerja sudah terdaftar.',
            'max' => 'Nama Unit Kerja tidak boleh lebih dari 10 karakter.',
        ],
        'newWorkUnitName' => [
            'required' => 'Nama Unit Kerja wajib diisi.',
            'string' => 'Nama Unit Kerja harus berupa teks.',
            'unique' => 'Nama Unit Kerja sudah terdaftar.',
            'max' => 'Nama Unit Kerja tidak boleh lebih dari 10 karakter.',
        ],
    ],
];
