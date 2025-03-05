<x-forms.input-form
    modalId="religionCreateModal"
    modalTitle="Tambah Agama"
    formId="religionCreateForm"
    :inputs="[
        ['label' => 'Nama Agama', 'name' => 'religionName', 'type' => 'text', 'value' => '']
    ]"
    submitButtonId="submitCreateReligion"
    submitButtonText="Simpan"
/>
