<x-forms.input-form
    modalId="workUnitCreateModal"
    modalTitle="Tambah Unit Kerja"
    formId="workUnitCreateForm"
    :inputs="[
        ['label' => 'Nama Unit Kerja', 'name' => 'workUnitName', 'type' => 'text', 'value' => '']
    ]"
    submitButtonId="submitCreateWorkUnit"
    submitButtonText="Simpan"
/>
