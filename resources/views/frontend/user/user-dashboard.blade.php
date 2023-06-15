@extends('frontend.layouts.main')

@section('content')
    <!--start page content-->
    <div class="page-content">


        <!--start breadcrumb-->
        <div class="py-4 border-bottom">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Account</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->


        <!--start product details-->
        <section class="section-padding">
            <div class="container">
                <div class="d-flex align-items-center px-3 py-2 border mb-4">
                    <div class="text-start">
                        <h4 class="mb-0 h4 fw-bold">Account - Profile</h4>
                    </div>
                </div>
                <div class="btn btn-dark btn-ecomm d-xl-none position-fixed top-50 start-0 translate-middle-y"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarFilter"><span><i
                            class="bi bi-person me-2"></i>Account</span></div>
                <div class="row">
                    <div class="col-12 col-xl-3 filter-column">
                        <nav class="navbar navbar-expand-xl flex-wrap p-0">
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbarFilter"
                                aria-labelledby="offcanvasNavbarFilterLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title mb-0 fw-bold text-uppercase" id="offcanvasNavbarFilterLabel">
                                        Account</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body account-menu">
                                    <div class="list-group w-100 rounded-0">
                                        <a href="{{ route('dashboard.user') }}" class="list-group-item active"><i
                                                class="bi bi-pencil me-2"></i>Profile</a>
                                        <a href="{{ route('ticket.index') }}" class="list-group-item"><i
                                                class="bi bi-ticket-perforated"></i> Tickets</a>
                                        <form id="form1" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="javascript:;" onclick="document.getElementById('form1').submit();"
                                                class="list-group-item"><i class="bi bi-power me-2"></i>Logout</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-12 col-xl-7">
                        <div class="card rounded-0">
                            <div class="card-body p-lg-5">
                                <h5 class="mb-0 fw-bold">Profile Details</h5>
                                <hr>
                                <div class="alert alert-danger fade show" role="alert" style="display: none;">
                                </div>
                                <form>
                                    <input type="hidden" id="user_id" name="user_id">
                                    <div class="row row-cols-1 g-3">
                                        <div class="col">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-0" placeholder="Name"
                                                    name="name" id="name">
                                                <label for="floatingInputName">Name</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-0" id="phone_number"
                                                    name="phone_number" placeholder="Phone Number">
                                                <label for="floatingInputNumber">Mobile Number</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-0" placeholder="Email"
                                                    name="email" id="email">
                                                <label for="floatingInputEmail">Email</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating">
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="">-- Select Gender --</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                                <label for="floatingMobileNo">Gender</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating">
                                                <input type="date" class="form-control rounded-0" id="date_birthday"
                                                    name="date_birthday">
                                                <label for="floatingInputDOB">Date of Birth</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-0" id="address"
                                                    name="address" placeholder="Address">
                                                <label for="floatingInputLocation">Address</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-0" id="job"
                                                    name="job" placeholder="Job">
                                                <label for="floatingInputLocation">Job</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button type="button" id="updateUser"
                                                class="btn btn-dark py-3 btn-ecomm w-100">Save
                                                Details</button>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-outline-dark py-3 btn-ecomm w-100"
                                                data-bs-toggle="modal" data-bs-target="#ChangePasswordModal">Change
                                                Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </section>
        <!--start product details-->


        <!-- Change Password Modal -->
        <div class="modal" id="ChangePasswordModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-0">
                    <div class="modal-body">
                        <h5 class="fw-bold mb-3">Change Password</h5>
                        <hr>
                        <div class="alert alert-danger fade show" role="alert" style="display: none;">
                        </div>
                        <form>
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->user_id }}">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control rounded-0" id="old_password"
                                    placeholder="Old Password" name="old_password">
                                <label for="old_password">Old Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control rounded-0" id="password"
                                    placeholder="New Password" name="password">
                                <label for="password">New Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control rounded-0" id="password_confirmation"
                                    placeholder="Confirm Password" name="password_confirmation">
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                            <div class="d-grid gap-3 w-100">
                                <button type="button" id="change-password"
                                    class="btn btn-dark py-3 btn-ecomm">Change</button>
                                <button type="button" class="btn btn-outline-dark py-3 btn-ecomm"
                                    data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Change Password Modal -->


    </div>
    <!--end page content-->

    </div>
    <!--end page content-->
@endsection


@push('script-alt')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }
            userData();

            function userData() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('get.dataRegis') }}",
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        $('#user_id').val(response.user_id)
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        $('#phone_number').val(response.phone_number);
                        $('#date_birthday').val(response.profile[0].date_birthday);
                        $('#gender').val(response.profile[0].gender);
                        $('#address').val(response.profile[0].address);
                        $('#job').val(response.profile[0].job);
                    }
                });
            }

            $('body').on('click', '#updateUser', function() {
                $(this).html('Sending..');

                $.ajax({
                    type: "POST",
                    url: "{{ route('update.userData') }}",
                    data: new FormData(this.form),
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        if (response.errors) {
                            $('#update-profile').html('Store Data Event');
                            $('.alert').html('');
                            $.each(response.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>' + value +
                                    '</li></strong>');
                            });
                            $('#updateUser').html('Save Details');
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
                            $('#updateUser').html('Save Details');
                            userData();
                        }
                    }
                });

            });

            $('body').on('click', '#change-password', function() {
                $(this).html('Sending..');

                $.ajax({
                    type: "POST",
                    url: "{{ route('update.Userpassword') }}",
                    data: new FormData(this.form),
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        if (response.errors) {
                            $('#update-profile').html('Store Data Event');
                            $('.alert').html('');
                            $.each(response.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>' + value +
                                    '</li></strong>');
                            });
                            $('#change-password').html('Change');
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
                            $('#change-password').html('Change');
                            $("#ChangePasswordModal").modal('hide');
                        }
                    }
                });
            })

        });
    </script>
@endpush
