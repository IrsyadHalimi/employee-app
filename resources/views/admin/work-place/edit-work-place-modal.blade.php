<x-forms.input-form
    modalId="workPlaceEditModal"
    modalTitle="Edit Tempat Tugas"
    formId="workPlaceEditForm"
    :inputs="[
        ['label' => 'ID Tempat Tugas', 'name' => 'workPlaceId', 'type' => 'hidden', 'value' => ''],
        ['label' => 'Nama Tempat Tugas', 'name' => 'newWorkPlaceName', 'type' => 'text', 'value' => '']
    ]"
    submitButtonId="submitEditWorkPlace"
    submitButtonText="Simpan"
/>
