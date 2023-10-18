<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    $('body').on('click', '#button-modal', function(e) {
        e.preventDefault();
        $('#modal-form').modal('show');

        $('#save').click(function() {
            var nama = $('#inputName').val();
            var phone = $('#inputPhone').val();
            Swal.fire(
                'Success!',
                'Data Berhasil Ditambahkan! ' + nama,
                'success'
            )
        });
    });
</script>
