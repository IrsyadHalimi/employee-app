<x-forms.input-form
    modalId="employeeEditModal"
    modalTitle="Edit Pegawai"
    formId="employeeEditForm"
    :inputs="[
        ['label' => 'NIP', 'name' => 'employeeId', 'type' => 'hidden', 'value' => ''],
        ['label' => 'NIP', 'name' => 'newEmployeeId', 'type' => 'text', 'value' => ''],
        ['label' => 'Nama', 'name' => 'name', 'type' => 'text', 'value' => ''],
        ['label' => 'Tempat Lahir', 'name' => 'birthPlace', 'type' => 'text', 'value' => ''],
        ['label' => 'Alamat', 'name' => 'address', 'type' => 'text', 'value' => ''],
        ['label' => 'Tanggal Lahir', 'name' => 'birthDate', 'type' => 'date'],
        ['label' => 'Jenis Kelamin', 'name' => 'gender', 'type' => 'radio', 'options' => [
            ['id' => 'male', 'value' => 'male', 'text' => 'Laki-laki'],
            ['id' => 'female', 'value' => 'female', 'text' => 'Perempuan']
        ]],
        ['label' => 'Golongan', 'name' => 'rankId', 'type' => 'select', 'valueKey' => 'id', 'textKey' => 'rank_name', 'options' => $ranks],
        ['label' => 'Eselon', 'name' => 'echelonId', 'type' => 'select', 'valueKey' => 'id', 'textKey' => 'echelon_name', 'options' => $echelons],
        ['label' => 'Jabatan', 'name' => 'positionId', 'type' => 'select', 'valueKey' => 'id', 'textKey' => 'position_description', 'options' => $positions],
        ['label' => 'Tempat Tugas', 'name' => 'workPlaceId', 'type' => 'select', 'valueKey' => 'id', 'textKey' => 'work_place_name', 'options' => $workPlaces],
        ['label' => 'Agama', 'name' => 'religionId', 'type' => 'select', 'valueKey' => 'id', 'textKey' => 'religion_name', 'options' => $religions],
        ['label' => 'Unit Kerja', 'name' => 'workUnitId', 'type' => 'select', 'valueKey' => 'id', 'textKey' => 'work_unit_name', 'options' => $workUnits],
        ['label' => 'No. HP', 'name' => 'phoneNumber', 'type' => 'number', 'value' => ''],
        ['label' => 'NPWP', 'name' => 'npwpNumber', 'type' => 'number', 'value' => ''],
        ['label' => 'Upload Foto', 'name' => 'img', 'type' => 'file', 'accept' => 'image/*', 'value' => '']
    ]"
    submitButtonId="submitEditEmployee"
    submitButtonText="Simpan"
/>
