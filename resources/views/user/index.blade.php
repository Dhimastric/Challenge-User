@extends('layouts.main')

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    {{-- <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <label>DASBOARD</label>
                        <hr>

                        Selamat Datang {{ Auth::user()->name }}

                    </div>
                </div>
            </div> --}}

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="p-2 bg-body rounded shadow-md">
                    {{-- Button Modal --}}
                    <button type="button" class="btn btn-primary" id="button-modal">
                        + Add Data
                    </button>

                    {{-- Table --}}
                    <div class="row justify-content-center">
                        <div class="mt-3">
                            <table class="table table-striped" id="userTable">
                                <thead>
                                    <tr class="table-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    {{-- Modal --}}
                    <div class="modal fade" id="modal-form" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body mb-4">
                                    <div class="alert alert-danger d-none" id="alertForm" role="alert"></div>

                                    <form class="row g-3">
                                        <div class="col-12">
                                            <label for="inputName" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="inputName" name="name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="inputEmail" name="email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPhone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="inputPhone" name="phone">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress" class="form-label">Address</label>
                                            <textarea class="form-control" rows="2" id="inputAddress" name="address"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="inputPassword" name="password">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputRole" class="form-label">Role</label>
                                            <select id="inputRole" class="form-select" name="role">
                                                <option value="0">Choose Role...</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="save"
                                        name="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ url('userAjax') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'name',
                    name: 'Name',
                }, {
                    data: 'email',
                    name: 'Email',
                }, {
                    data: 'role',
                    name: 'Role',
                }, {
                    data: 'action',
                    name: 'Action',
                }]
            });
        });

        // Setup CSRF Token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Simpan Data
        $('body').on('click', '#button-modal', function(e) {
            e.preventDefault();
            $('#modal-form').modal('show');
            $('#save').click(function() {
                save();
            });
        });

        // Edit Data
        $('body').on('click', '#edit-button', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: 'userAjax/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#modal-form').modal('show');

                    $('#inputName').val(response.result.name);
                    $('#inputEmail').val(response.result.email);
                    $('#inputPhone').val(response.result.phone);
                    $('#inputAddress').val(response.result.address);
                    $('#inputRole').val(response.result.role);

                    $('#save').click(function() {
                        save(id);
                    });
                }
            });
        });

        // Delete Data
        $('body').on('click', '#delete-button', function(e) {
            Swal.fire({
                title: 'Confirm Delete',
                text: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    $.ajax({
                        url: 'userAjax/' + id,
                        type: 'DELETE',
                        success: function(response) {
                            Swal.fire('Deleted!', 'Your data has been deleted.', 'success');
                            $('#userTable').DataTable().ajax.reload();
                        },
                    });
                }
            });
        });

        // Function Save and Update
        function save(id = '') {
            if (id == '') {
                var form_url = 'userAjax';
                var form_type = 'POST';
            } else {
                var form_url = 'userAjax/' + id;
                var form_type = 'PUT';
            }
            $.ajax({
                url: form_url,
                type: form_type,
                data: {
                    name: $('#inputName').val(),
                    email: $('#inputEmail').val(),
                    phone: $('#inputPhone').val(),
                    address: $('#inputAddress').val(),
                    password: $('#inputPassword').val(),
                    role: $('#inputRole').val(),
                },
                success: function(response) {
                    if (response.errors) {
                        $('#alertForm').removeClass('d-none');
                        $('#alertForm').append('<ul>');
                        $.each(response.errors, function(key, val) {
                            $('#alertForm').find('ul').append("<li>" + val +
                                "</li>");
                        });
                        $('#alertForm').append('</ul>');
                    } else {
                        Swal.fire('Success!', response.success, 'success');
                        $('#modal-form').modal('hide');
                        $('#userTable').DataTable().ajax.reload();
                    }
                }
            });
        }

        // Modal Close / Hidden
        $('#modal-form').on('hidden.bs.modal', function() {
            $('#inputName').val('');
            $('#inputEmail').val('');
            $('#inputPhone').val('');
            $('#inputAddress').val('');
            $('#inputPassword').val('');
            $('#inputRole').val('0');

            $('#alertForm').addClass('d-none');
            $('#alertForm').html('');
        });
    </script>
@endpush
