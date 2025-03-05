<x-forms.input-form
    modalId="positionEditModal"
    modalTitle="Edit Jabatan"
    formId="positionEditForm"
    :inputs="[
        ['label' => 'ID Jabatan', 'name' => 'positionId', 'type' => 'hidden', 'value' => ''],
        ['label' => 'Nama Jabatan', 'name' => 'newPositionDescription', 'type' => 'text', 'value' => '']
    ]"
    submitButtonId="submitEditPosition"
    submitButtonText="Simpan"
/>
