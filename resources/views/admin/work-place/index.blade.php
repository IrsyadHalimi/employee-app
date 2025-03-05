@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tempat Tugas') }}</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#workPlaceCreateModal">
                        Tambah Tempat Tugas
                    </button>
                    <div class="table-responsive">
                        <x-tables.table-data name="workPlaceTable" :options="['No', 'Nama Tempat Tugas', 'Aksi']" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.work-place.create-work-place-modal')
@include('admin.work-place.edit-work-place-modal')
@endsection
@section('scripts')
<script>
    var table;

    $(document).ready(function () {
        table = $('#workPlaceTable').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.work-place.data') }}",
            },
            columns: [
                {
                    className: 'dt-control',
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'work_place_name', name: 'work_place_name' },
                { data: 'action', name: 'action' },
            ]
        });

        $('#workPlaceCreateForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var submitButton = $('#submitCreateWorkPlace');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.work-place.store') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#workPlaceCreateModal').modal('hide');
                            $('#workPlaceCreateForm')[0].reset();
                            table.ajax.reload();
                        })
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function (key, value) {
                        errorMessage += value + '\n';
                    });
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                },
                complete: function () {
                    table.processing(false);
                    submitButton.prop('disabled', false).html('Simpan');
                }
            });
        });

        $(document).on('click', '.editButton', function() {
            var workPlaceId = atob($(this).data('work_place_id'));
            var workPlaceName = atob($(this).data('work_place_name'));

            $('#workPlaceEditModal #workPlaceId').val(workPlaceId);
            $('#workPlaceEditModal #newWorkPlaceName').val(workPlaceName);

            $('#workPlaceEditModal').modal('show');
        });

        $('#workPlaceEditForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var submitButton = $('#submitEditWorkPlace');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.work-place.update') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#workPlaceCreateModal').modal('hide');
                            $('#workPlaceCreateForm')[0].reset();
                            table.ajax.reload();
                        });
                        $('#workPlaceEditModal').modal('hide');
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function (key, value) {
                        errorMessage += value + '\n';
                    });
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                },
                complete: function () {
                    table.processing(false);
                    submitButton.prop('disabled', false).html('Simpan');
                }
            });
        });

        $('#workPlaceEditModal').on('shown.bs.modal', function () {
            $(this).removeAttr('aria-hidden');
        });

        $('#workPlaceEditModal').on('hidden.bs.modal', function () {
            $(this).attr('aria-hidden', 'true');
        });
    });

    function deleteWorkPlace(workPlaceId) {
        if(workPlaceId != "") {
            Swal.fire({
            title: 'Anda yakin ingin menghapus?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true,
            reverseButtons: false,
            focusCancel: false,
        }).then((result) => {
            if (result.isConfirmed) {
                table.processing(true);
                let token = document.getElementsByName('_token')[0].value.trim();
                let url = '{{ route('admin.work-place.destroy') }}';
                $.ajax({
                    url : url,
                    type : 'DELETE',
                    dataType : 'json',
                    data : {
                        _token : token,
                        workPlaceId: workPlaceId
                    },
                    success : function(response) {
                        table.ajax.reload();
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error : function(response) {
                        $('#loading').hide();
                        Swal.fire({
                            title: 'Gagal!',
                            text: response.message,
                            icon: 'error',
                        });
                    },
                    complete: function() {
                        table.processing(false);
                        table.ajax.reload();
                    }
                });
                table.processing(false);
            }
        });
        } else {
            Swal.fire({
                title: 'Gagal!',
                text: response.message,
                icon: 'error',
            });
        }
    }
</script>
@endsection
