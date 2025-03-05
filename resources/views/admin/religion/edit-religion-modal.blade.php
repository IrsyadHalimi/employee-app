<x-forms.input-form
    modalId="religionEditModal"
    modalTitle="Edit Agama"
    formId="religionEditForm"
    :inputs="[
        ['label' => 'ID Golongan', 'name' => 'religionId', 'type' => 'hidden', 'value' => ''],
        ['label' => 'Nama Golongan', 'name' => 'newReligionName', 'type' => 'text', 'value' => '']
    ]"
    submitButtonId="submitEditReligion"
    submitButtonText="Simpan"
/>
