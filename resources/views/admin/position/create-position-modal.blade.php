<x-forms.input-form
    modalId="positionCreateModal"
    modalTitle="Tambah Jabatan"
    formId="positionCreateForm"
    :inputs="[
        ['label' => 'Nama Jabatan', 'name' => 'positionDescription', 'type' => 'text', 'value' => '']
    ]"
    submitButtonId="submitCreatePosition"
    submitButtonText="Simpan"
/>
