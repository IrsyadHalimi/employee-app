<x-forms.input-form
    modalId="workUnitEditModal"
    modalTitle="Edit Tempat Tugas"
    formId="workUnitEditForm"
    :inputs="[
        ['label' => 'ID Tempat Tugas', 'name' => 'workUnitId', 'type' => 'hidden', 'value' => ''],
        ['label' => 'Nama Tempat Tugas', 'name' => 'newWorkUnitName', 'type' => 'text', 'value' => '']
    ]"
    submitButtonId="submitEditWorkUnit"
    submitButtonText="Simpan"
/>
