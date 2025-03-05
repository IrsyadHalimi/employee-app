<x-forms.input-form
    modalId="rankEditModal"
    modalTitle="Edit Golongan"
    formId="rankEditForm"
    :inputs="[
        ['label' => 'ID Golongan', 'name' => 'rankId', 'type' => 'hidden', 'value' => ''],
        ['label' => 'Nama Golongan', 'name' => 'newRankName', 'type' => 'text', 'value' => '']
    ]"
    submitButtonId="submitEditRank"
    submitButtonText="Simpan"
/>
