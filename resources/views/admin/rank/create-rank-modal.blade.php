<x-forms.input-form
    modalId="rankCreateModal"
    modalTitle="Tambah Golongan"
    formId="rankCreateForm"
    :inputs="[
        ['label' => 'Nama Golongan', 'name' => 'rankName', 'type' => 'text', 'value' => '']
    ]"
    submitButtonId="submitCreateRank"
    submitButtonText="Simpan"
/>
