@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#religionCreateModal">
                        Tambah Agama
                    </button>
                    <div class="table-responsive">
                        <table id="religionTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Agama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.religion.create-religion-modal')
@include('admin.religion.edit-religion-modal')
@endsection
@section('scripts')
<script>
    var table;

    $(document).ready(function () {
        table = $('#religionTable').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.religion.data') }}",
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
                { data: 'religion_name', name: 'religion_name' },
                { data: 'action', name: 'action' },
            ]
        });

        $('#religionCreateForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var submitButton = $('#submitCreateReligion');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.religion.store') }}",
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
                            $('#religionCreateModal').modal('hide');
                            $('#religionCreateForm')[0].reset();
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
            var religionId = atob($(this).data('religion_id'));
            var religionName = atob($(this).data('religion_name'));

            $('#religionEditModal #religionId').val(religionId);
            $('#religionEditModal #newReligionName').val(religionName);

            $('#religionEditModal').modal('show');
        });

        $('#religionEditForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var submitButton = $('#submitEditReligion');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.religion.update') }}",
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
                            $('#religionCreateModal').modal('hide');
                            $('#religionCreateForm')[0].reset();
                            table.ajax.reload();
                        });
                        $('#religionEditModal').modal('hide');
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
    });

    function deleteReligion(religionId) {
        if(religionId != "") {
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
                let url = '{{ route('admin.religion.destroy') }}';
                $.ajax({
                    url : url,
                    type : 'DELETE',
                    dataType : 'json',
                    data : {
                        _token : token,
                        religionId: religionId
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
