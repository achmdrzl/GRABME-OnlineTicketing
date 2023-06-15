@extends('frontend.layouts.main')

@push('style-alt')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="{{ config('midtrans.snap_url') }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
@endpush

@section('content')
    <!--start page content-->
    <div class="page-content">

        <!--start breadcrumb-->
        <div class="py-4 border-bottom">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">checkout</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Billing Details</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!--end breadcrumb-->
        <!--start product details-->
        <section class="section-padding">
            <div class="container">
                <div class="alert alert-warning"><i class="bi bi-info-circle-fill"></i> Make sure your e-mail & all your
                    data that you will fill in is correct. E-tickets will only be sent to the primary email that you
                    registered.</div>
                <div class="d-flex align-items-center px-3 py-2 border mb-4">
                    <div class="text-start">
                        <h4 class="mb-0 h4 fw-bold">Billing Details</h4>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-lg-8 col-xl-8">

                        <h6 class="fw-bold mb-3 py-2 px-3 bg-light">Registration Data</h6>
                        <div class="card rounded-0 mb-3">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="btn btn-danger fade show" role="alert" style="display: none;">
                                    </div>
                                    <form>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-0" id="name"
                                                    name="name" placeholder="First Name">
                                                <label for="floatingFirstName">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-0" id="email"
                                                    name="email" placeholder="Email">
                                                <label for="floatingEmail">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-0" id="phone_number"
                                                    name="phone_number" placeholder="Mobile No">
                                                <label for="floatingMobileNo">Mobile No</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-floating">
                                                <input type="date" class="form-control rounded-0" id="date_birthday"
                                                    name="date_birthday" placeholder="Date Birthday">
                                                <label for="floatingMobileNo">Date Birthday</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-floating">
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="">-- Select Gender --</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                                <label for="floatingMobileNo">Gender</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-0" id="address"
                                                    name="address" placeholder="Address">
                                                <label for="floatingMobileNo">Address</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-0" id="job"
                                                    name="job" placeholder="Job">
                                                <label for="floatingMobileNo">Job</label>
                                            </div>
                                        </div>
                                </div>
                                <!--end row-->
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3 py-2 px-3 bg-light">Registration Data</h6>
                        {{-- <div class="card rounded-0">
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="checkbox" class="form-group"> Same as registration data
                                </div>
                                <div class="row g-3">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control rounded-0" id="name"
                                                placeholder="First Name">
                                            <label for="floatingFirstName">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control rounded-0" id="floatingEmail"
                                                placeholder="Email">
                                            <label for="floatingEmail">Email</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control rounded-0" id="floatingMobileNo"
                                                placeholder="Mobile No">
                                            <label for="floatingMobileNo">Mobile No</label>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                        </div> --}}


                    </div>
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="card rounded-0 mb-3">
                            <div class="card-body">
                                @if (session('data'))
                                    @php($data = session('data'))
                                    <input type="hidden" name="event_id" id="event_id" value="{{ $data['event_id'] }}">
                                    <h5 class="fw-bold mb-4">Order Summary</h5>
                                    <div class="hstack align-items-center justify-content-between">
                                        <p class="mb-0">Name Event</p>
                                        <p class="mb-0">{{ $data['event']['event_name'] }}</p>
                                    </div>
                                    <hr>
                                    <div class="hstack align-items-center justify-content-between">
                                        <p class="mb-0">Date Held</p>
                                        <p class="mb-0">{{ date('d F Y', strtotime($data['event']['date_held'])) }}
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="justify-content-between mx-auto">
                                        <p class="mb-3 text-center" style="border-bottom:1px"><strong>Ticket
                                                Details</strong></p>
                                        @php($amount = $data['amount_ticket'])
                                        @php($category = $data['ticketCategory'])
                                        @php($price = $data['price'])
                                        @php($ticketDetails = array_combine($category, array_map(null, $amount, $price)))
                                        @foreach ($ticketDetails as $detail => $value)
                                            <div class="hstack align-items-center justify-content-between">
                                                <p class="mb-0"><strong>{{ ucfirst($detail) }}</strong> x
                                                    {{ $value[0] }} | Rp. {{ number_format($value[1]) }}</p>
                                                <p class="mb-0">
                                                    Rp. {{ number_format($value[0] * $value[1]) }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="hstack align-items-center justify-content-between">
                                        <p class="mb-0">Total Ticket</p>
                                        <p class="mb-0">Rp. {{ number_format($data['totalPrice']) }}</p>
                                    </div>
                                    <hr>
                                    <div class="hstack align-items-center justify-content-between">
                                        <p class="mb-0">Internet Tax</p>
                                        <p class="mb-0 text-success" id="internetTax">Rp
                                            {{ number_format($data['internetTax']) }}</p>
                                    </div>
                                    <hr>
                                    <div class="hstack align-items-center justify-content-between fw-bold text-content">
                                        <p class="mb-0">Total Payment</p>
                                        <p class="mb-0" id="totalPayment">Rp
                                            {{ number_format($data['totalPrice'] + $data['internetTax']) }}</p>
                                    </div>
                                    <div class="d-grid mt-4">
                                        <button type="button" id="pay"
                                            class="btn btn-dark btn-ecomm py-3 px-5">Pay</button>
                                    </div>
                                @endif
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end row-->
            </div>
    </div>
    </section>
    <!--start product details-->

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

            $.ajax({
                type: "GET",
                url: "{{ route('get.dataRegis') }}",
                dataType: "JSON",
                success: function(response) {
                    console.log(response)
                    $('#name').val(response.name);
                    $('#email').val(response.email);
                    $('#phone_number').val(response.phone_number);
                    $('#date_birthday').val(response.profile[0].date_birthday);
                    $('#gender').val(response.profile[0].gender);
                    $('#address').val(response.profile[0].address);
                    $('#job').val(response.profile[0].job);
                }
            });


            $('body').on('click', '#pay', function() {
                $(this).html('Sending..');

                $.ajax({
                    type: "POST",
                    url: "{{ route('order') }}",
                    data: new FormData(this.form),
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        if (response.errors) {
                            $('#update-profile').html('Store Data Event');
                            $('.btn').html('');
                            $.each(response.errors, function(key, value) {
                                $('.btn-danger').show();
                                $('.btn-danger').append('<strong><li>' + value +
                                    '</li></strong>');
                            });
                            $('#pay').html('PAY');
                        } else {
                            $('.btn-danger').hide();
                            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                            window.snap.pay(response.snapToken, {
                                onSuccess: function(result) {
                                    /* You may add your own implementation here */
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('delete.session') }}",
                                        data: {
                                            session_key: 'data'
                                        },
                                        dataType: "JSON",
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
                                                title: `${response.message}`,
                                            })

                                            $('#pay').html('PAY');
                                            setTimeout
                                                (function() {
                                                        window
                                                            .location
                                                            .href =
                                                            '{{ route('history.index') }}';
                                                    },
                                                    3000
                                                );
                                        }
                                    });

                                },
                                onPending: function(result) {
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('delete.session') }}",
                                        data: {
                                            session_key: 'data'
                                        },
                                        dataType: "JSON",
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
                                                title: `${response.message}`,
                                            })

                                            $('#pay').html('PAY');
                                            setTimeout
                                                (function() {
                                                        window
                                                            .location
                                                            .href =
                                                            '{{ route('history.index') }}';
                                                    },
                                                    3000
                                                );
                                        }
                                    });

                                },
                                onError: function(result) {
                                    /* You may add your own implementation here */
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('delete.transaction') }}",
                                        data: {
                                            session_key: 'data'
                                        },
                                        dataType: "JSON",
                                        success: function(response) {
                                            Swal.fire("Cancel!",
                                                "Payment error, please do it again!",
                                                "error");
                                            $('#pay').html('PAY');
                                        }
                                    });
                                },
                                onClose: function() {
                                    /* You may add your own implementation here */
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('delete.transaction') }}",
                                        data: {
                                            session_key: 'data'
                                        },
                                        dataType: "JSON",
                                        success: function(response) {
                                            Swal.fire("Cancel!",
                                                "Payment canceled, your payment has been canceled!",
                                                "error");
                                            $('#pay').html('PAY');
                                        }
                                    });
                                }
                            })

                        }
                    }
                });
            });

        });
    </script>
@endpush
