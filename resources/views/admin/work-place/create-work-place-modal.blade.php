<x-forms.input-form
    modalId="workPlaceCreateModal"
    modalTitle="Tambah Tempat Tugas"
    formId="workPlaceCreateForm"
    :inputs="[
        ['label' => 'Nama Tempat Tugas', 'name' => 'workPlaceName', 'type' => 'text', 'value' => '']
    ]"
    submitButtonId="submitCreateWorkPlace"
    submitButtonText="Simpan"
/>
