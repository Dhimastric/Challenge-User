<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Challenge</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body class="bg-light">
    <div class="container">
        <div class="my-4 p-4 bg-body rounded shadow-md">
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
                            <button type="button" class="btn btn-primary" id="save" name="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('user.script')
</body>

</html>
