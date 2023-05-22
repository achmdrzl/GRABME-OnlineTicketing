@extends('backend.layouts.main')

@push('style-alt')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data User</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary user-create float-end" data-bs-toggle="modal"
                            data-bs-target="#userModal">
                            <i class="icon-md" data-feather="plus"></i> Add Data
                        </button>
                        <h6 class="card-title">Data Users</h6>
                        <p class="text-muted mb-3">Detail from data users.</p>
                        <div class="table-responsive">
                            <table id="user-datatable" class="table w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Position</th>
                                        <th>Status Akun</th>
                                        <th>Action</th>
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

    <!-- Modal Data User-->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userHeading"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;"
                        style="color: red">
                    </div>
                    <form id="Userform">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off"
                                placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" autocomplete="off"
                                placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" name="phone_number" id="phone_number"
                                autocomplete="off" placeholder="Phone Number">
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Positions</label>
                            <select class="form-select" name="role" id="role">
                                <option value="" selected disabled>-- Select Position --</option>
                                @foreach ($role as $item)
                                    <option value="{{ $item->name }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="date_birthday" class="form-label">Date Birthday</label>
                            <input type="date" class="form-control" name="date_birthday" id="date_birthday"
                                autocomplete="off" placeholder="Date Birthday">
                        </div>
                        <label for="gender" class="form-label">Gender</label>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="gender" id="gender"
                                    value="male">
                                <label class="form-check-label" for="checkInline">
                                    Male
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="gender" id="gender"
                                    value="female">
                                <label class="form-check-label" for="checkInline">
                                    Female
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form form-control" placeholder="Your Address"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="job" class="form-label">Job</label>
                            <input type="text" class="form-control" name="job" id="job" autocomplete="off"
                                placeholder="Job">
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo" autocomplete="off"
                                placeholder="Photo">
                        </div> --}}
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" autocomplete="off"
                                placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password Confirmation</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" autocomplete="off" placeholder="Password Confirmation">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitBtnUser" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-alt')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
    <!-- End custom js for this page -->

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Rendering Table
            var table = $('#user-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'status_akun',
                        name: 'status_akun'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // $('#gambar_lap').change(function() {
            //     let reader = new FileReader();
            //     reader.onload = (e) => {
            //         $('#image_preview').attr('src', e.target.result);
            //     }
            //     reader.readAsDataURL(this.files[0]);
            // })

            // Create Data User.
            $('.user-create').click(function() {
                $('.alert').hide();
                $('#submitBtnUser').val(".");
                $('#userForm').trigger("reset");
                $('#userHeading').html("ADD NEW USER");
                $('#userModal').modal('show');
                $('#user_id').val('');
                $('#name').val('');
                $('#email').val('');
                $('#phone_number').val('');
                $('#role').val('');
                $('#password').val('');
                $('#password_confirmation').val('');
            });

            // Store or Update Data User
            $('#submitBtnUser').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                var formData = new FormData();
                formData.append('user_id', $("#user_id").val());
                formData.append('name', $("#name").val());
                formData.append('email', $("#email").val());
                formData.append('phone_number', $("#phone_number").val());
                formData.append('role', $("#role").val());
                formData.append('password', $("#password").val());
                formData.append('password_confirmation', $("#password_confirmation").val());

                $.ajax({
                    url: "{{ route('user.store') }}",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,

                    success: function(response) {
                        console.log(response)
                        if (response.errors) {
                            $('#update-profile').html('Store Data User');
                            $('.alert').html('');
                            $.each(response.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>' + value +
                                    '</li></strong>');
                            });
                            $('#submitBtnUser').html('Simpan');
                        } else {
                            $('.alert-danger').hide();
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });

                            Toast.fire({
                                icon: 'success',
                                title: `${response.message}`,
                            })

                            $('#userForm').trigger("reset");
                            $('#submitBtnUser').html('Simpan');
                            $('#userModal').modal('hide');
                            table.draw();
                        }
                    }
                });
            });

            // Edit Data User
            $('body').on('click', '#user-edit', function() {
                var user_id = $(this).attr('data-id');
                $('.alert').hide();
                $.ajax({
                    type: "POST",
                    url: "{{ route('user.selected') }}",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        $('#submitBtnUser').val("user-edit");
                        $('#userForm').trigger("reset");
                        $('#userHeading').html("EDIT DATA USER");
                        $('#userModal').modal('show');
                        $('#user_id').val(response.user_id);
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        $('#phone_number').val(response.phone_number);
                        $('#role').val(response.role);
                        $('#password').val('');
                        $('#password_confirmation').val('');
                    }
                });
            });

            // Arsipkan Data User
            $('body').on('click', '.user-delete', function() {

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger me-2",
                    },
                    buttonsStyling: false,

                });

                var user_id = $(this).attr('data-id');
                if ($('#user-' + user_id).hasClass("aktif")) {
                    var title = "Do you want to disable, this data?"
                    var text = "This data will be archived!"
                } else {
                    var title = "Do you want to activate, this data?"
                    var text = "This data will be displayed!"
                }

                swalWithBootstrapButtons
                    .fire({
                        title: title,
                        text: text,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "me-2",
                        cancelButtonText: "Tidak",
                        confirmButtonText: "Ya",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('user.destroy') }}",
                                data: {
                                    user_id: user_id,
                                },
                                dataType: "json",
                                success: function(response) {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });

                                    Toast.fire({
                                        icon: 'success',
                                        title: `${response.status}`,
                                    })
                                    table.draw();
                                }
                            });
                        } else {
                            Swal.fire("Cancel!", "Perintah dibatalkan!", "error");
                        }
                    });

            });

        });
    </script>
@endpush
