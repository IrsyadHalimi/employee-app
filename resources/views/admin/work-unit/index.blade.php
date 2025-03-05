@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Unit Kerja') }}</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#workUnitCreateModal">
                        Tambah Tempat Tugas
                    </button>
                    <div class="table-responsive">
                        <x-tables.table-data name="workUnitTable" :options="['No', 'Nama Unit Kerja', 'Aksi']" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.work-unit.create-work-unit-modal')
@include('admin.work-unit.edit-work-unit-modal')
@endsection
@section('scripts')
<script>
    var table;

    $(document).ready(function () {
        table = $('#workUnitTable').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.work-unit.data') }}",
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
                { data: 'work_unit_name', name: 'work_unit_name' },
                { data: 'action', name: 'action' },
            ]
        });

        $('#workUnitCreateForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var submitButton = $('#submitCreateWorkUnit');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.work-unit.store') }}",
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
                            $('#workUnitCreateModal').modal('hide');
                            $('#workUnitCreateForm')[0].reset();
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
            var workUnitId = atob($(this).data('work_unit_id'));
            var workUnitName = atob($(this).data('work_unit_name'));

            $('#workUnitEditModal #workUnitId').val(workUnitId);
            $('#workUnitEditModal #newWorkUnitName').val(workUnitName);

            $('#workUnitEditModal').modal('show');
        });

        $('#workUnitEditForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var submitButton = $('#submitEditWorkUnit');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.work-unit.update') }}",
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
                            $('#workUnitCreateModal').modal('hide');
                            $('#workUnitCreateForm')[0].reset();
                            table.ajax.reload();
                        });
                        $('#workUnitEditModal').modal('hide');
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

        $('#workUnitEditModal').on('shown.bs.modal', function () {
            $(this).removeAttr('aria-hidden');
        });

        $('#workUnitEditModal').on('hidden.bs.modal', function () {
            $(this).attr('aria-hidden', 'true');
        });
    });

    function deleteWorkUnit(workUnitId) {
        if(workUnitId != "") {
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
                let url = '{{ route('admin.work-unit.destroy') }}';
                $.ajax({
                    url : url,
                    type : 'DELETE',
                    dataType : 'json',
                    data : {
                        _token : token,
                        workUnitId: workUnitId
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
