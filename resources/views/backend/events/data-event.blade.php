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
                <li class="breadcrumb-item"><a href="#">Data Event</a></li>
                <li class="breadcrumb-item active" aria-current="page">Events</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('event.add') }}">
                            <button class="btn btn-primary user-create float-end" data-bs-toggle="modal"
                                data-bs-target="#userModal">
                                <i class="icon-md" data-feather="plus"></i> Add Data
                            </button>
                        </a>
                        <h6 class="card-title">Data Events</h6>
                        <p class="text-muted mb-3">Detail from data events.</p>
                        <div class="table-responsive">
                            <table id="user-datatable" class="table w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Event</th>
                                        <th>Date Held</th>
                                        <th>Status Event</th>
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
