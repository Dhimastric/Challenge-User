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
