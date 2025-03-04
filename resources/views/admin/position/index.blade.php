@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Jabatan') }}</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#positionCreateModal">
                        Tambah Jabatan
                    </button>
                    <div class="table-responsive">
                        <table id="positionTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jabatan</th>
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
@include('admin.position.create-position-modal')
@include('admin.position.edit-position-modal')
@endsection
@section('scripts')
<script>
    var table;

    $(document).ready(function () {
        table = $('#positionTable').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.position.data') }}",
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
                { data: 'position_description', name: 'position_description' },
                { data: 'action', name: 'action' },
            ]
        });

        $('#positionCreateForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var submitButton = $('#submitCreatePosition');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.position.store') }}",
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
                            $('#positionCreateModal').modal('hide');
                            $('#positionCreateForm')[0].reset();
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
            var positionId = atob($(this).data('position_id'));
            var positionDescription = atob($(this).data('position_description'));

            $('#positionEditModal #positionId').val(positionId);
            $('#positionEditModal #newPositionDescription').val(positionDescription);

            $('#positionEditModal').modal('show');
        });

        $('#positionEditForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var submitButton = $('#submitEditPosition');

            table.processing(true);
            submitButton.prop('disabled', true).html('Menyimpan...');

            $.ajax({
                url: "{{ route('admin.position.update') }}",
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
                            $('#positionCreateModal').modal('hide');
                            $('#positionCreateForm')[0].reset();
                            table.ajax.reload();
                        });
                        $('#positionEditModal').modal('hide');
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

    function deletePosition(positionId) {
        if(positionId != "") {
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
                let url = '{{ route('admin.position.destroy') }}';
                $.ajax({
                    url : url,
                    type : 'DELETE',
                    dataType : 'json',
                    data : {
                        _token : token,
                        positionId: positionId
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
