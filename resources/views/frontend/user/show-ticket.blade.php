<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('frontend/assets/images/favicon-32x32.webp') }}')}}" type="image/webp" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- CSS files -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/plugins/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/plugins/slick/slick-theme.css') }}" />

    <!-- Plugin sweet alert -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}" />
    <!-- End of Custom plugin -->

    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/dark-theme.css') }}" rel="stylesheet">
    @stack('style-alt')
    <title>GrabMe - Ticketing</title>
</head>

<body>

    <!--start top header-->
    <header class="top-header">
        <nav class="navbar navbar-expand-xl w-100 sticky-top navbar-dark container gap-3">
            <a class="navbar-brand d-none d-xl-inline" href="#"><img
                    src="{{ asset('frontend/assets/images/grabme.png') }}" class="logo-img" alt=""></a>
            <a class="mobile-menu-btn d-inline d-xl-none" href="#">
                <img src="{{ asset('frontend/assets/images/grabme.png') }}" class="logo-img" alt="">
                {{-- <i class="bi bi-list"></i> --}}
            </a>
        </nav>
    </header>
    <!--end top header-->



    <!--start page content-->
    <div class="page-content">

        <!--start product details-->
        <section class="section-padding">
            <div class="container">

                <div class="separator mb-3">
                    <div class="line"></div>
                    <h3 class="mb-0 h3 fw-bold">Thank You!</h3>
                    <div class="line"></div>
                </div>

                <div class="border p-4 text-center w-100">
                    <h5 class="fw-bold mb-2">Thank You for Believing on us.</h5>
                    <p class="mb-0">We have recived your order. We hope there will still be further orders.</p>
                </div>
                <div class="border p-4 mt-4 text-center w-100">
                    <h5 class="fw-bold mb-2">User data order.</h5>
                    <p class="mb-4">please check the correctness of the data after ordering.</p>

                    <table class="table">
                        <tr>
                            <td>Name Order : </td>
                            <td>{{ $data->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Email Order : </td>
                            <td>{{ ucfirst($data->user->email) }}</td>
                        </tr>
                        <tr>
                            <td>Phone Number : </td>
                            <td>{{ $data->user->phone_number }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="border p-4 mt-4 text-center w-100">
                    <h5 class="fw-bold mb-2">The following is transaction order data.</h5>
                    <p class="mb-4">please check the correctness of the data after ordering.</p>

                    <table class="table">
                        <tr>
                            <td>Order Code : </td>
                            <td>{{ Str::limit($data->order_id, 15) }}</td>
                        </tr>
                        <tr>
                            <td>Event Name : </td>
                            <td>{{ ucfirst($data->event->event_name) }}</td>
                        </tr>
                        <tr>
                            <td>Payment Type : </td>
                            <td>{{ ucfirst($data->payment_type == 'bank_transfer' ? 'Bank Transfer' : 'E-wallet') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status Payment : </td>
                            <td>
                                <div class="badge bg-success">{{ ucfirst($data->status_payment) }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Payment : </td>
                            <td>Rp. {{ number_format($data->total_payment) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="border p-4 mt-4 text-center w-100">
                    <h5 class="fw-bold mb-2">The following is your order detail.</h5>
                    <p class="mb-4">please check the correctness of the data after ordering.</p>

                    <table class="table">
                        @foreach ($data->transaksiDetail as $item)
                            <tr>
                                <td>Ticket Category {{ $loop->iteration }} : </td>
                                <td>{{ ucfirst($item->ticketCategory->ticket_category_name) }} |
                                    x{{ $item->amount_ticket }} tickets
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </section>
        <!--start product details-->

    </div>
    <!--end page content-->

    <footer class="footer-strip text-center py-3 bg-section-2 border-top positon-absolute bottom-0">
        <p class="mb-0 text-muted">© 2023. grabme.co@gmail.com | All rights reserved.</p>
    </footer>

    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!--End Back To Top Button-->


    <!-- JavaScript files -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/index.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/loader.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    @stack('script-alt')
</body>

</html>
