<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Setup CSRF Token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Function Login
    function login() {
        if ($('#email').val() == "") {
            $('#email').addClass('is-invalid');
        } else if ($('#password').val() == "") {
            $('#password').addClass('is-invalid');
        } else {
            $('#email').removeClass('is-invalid');
            $('#password').removeClass('is-invalid');
            var $data = $('#form-login').serialize();

            $.ajax({
                url: '/login',
                type: 'POST',
                data: $data,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                                title: 'You are logged in!',
                                text: 'You will be redirected in 3 seconds!',
                                icon: 'success',
                                timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                            .then(function() {
                                window.location.href = "{{ route('dashboard') }}";
                            });
                    } else {
                        Swal.fire('Login Failed!', 'Wrong Email or Password', 'error');
                    }
                }
            });
        }
    }
</script>
