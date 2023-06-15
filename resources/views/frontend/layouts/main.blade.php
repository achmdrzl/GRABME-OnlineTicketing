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

    @include('frontend.layouts.navbar')


    <!--start page content-->
    @yield('content')
    <!--end page content-->


    <!--subscribe banner-->
    <section class="product-thumb-slider subscribe-banner p-5">
        <div class="row">
            <div class="col-12 col-lg-6 mx-auto">
                <div class="text-center">
                    <h3 class="mb-0 fw-bold text-white">Ready to Create Event With Us?</h3>
                    <p class="mb-0 fw-bold text-white">Tell us about your upcoming event and we’ll make your event become awesome.</p>
                    {{-- <div class="mt-3">
                        <input type="text" class="form-control form-control-lg bubscribe-control rounded-0 px-5 py-3"
                            placeholder="Enter your email">
                    </div> --}}
                    <div class="mt-3 d-grid">
                        <button type="button"
                            class="btn btn-lg btn-ecomm bubscribe-button px-5 py-3">Learn More About Us</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--subscribe banner-->

    <!--start footer-->
    <section class="footer-section bg-section-2 section-padding">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-4 g-4">
                <div class="col">
                    <div class="footer-widget-6">
                        <img src="{{ asset('frontend/assets/images/grabme.png') }}" class="logo-img mb-3"
                            alt="">
                        <h5 class="mb-3 fw-bold">About Us</h5>
                        <p class="mb-2">GrabMe is an online ticket purchasing service that offers a convenient and
                            efficient platform for users to search, select, and buy tickets for a wide range of events
                            and concerts. It provides comprehensive event information, secure payment options,
                            electronic ticket delivery, and responsive customer service. With GrabMe, users can easily
                            access and enjoy their favorite events without the hassle of physical ticket purchases,
                            making the process of attending concerts and events more convenient and enjoyable.</p>

                        <a class="link-dark" href="javascript:;">Read More</a>
                    </div>
                </div>
                <div class="col">
                    <div class="footer-widget-7">
                        <h5 class="mb-3 fw-bold">Explore</h5>
                        <ul class="widget-link list-unstyled">
                            <li><a href="javascript:;">Event</a></li>
                            <li><a href="javascript:;">Concert</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="footer-widget-8">
                        <h5 class="mb-3 fw-bold">Company</h5>
                        <ul class="widget-link list-unstyled">
                            <li><a href="javascript:;">About Us</a></li>
                            <li><a href="javascript:;">Contact Us</a></li>
                            <li><a href="javascript:;">FAQ</a></li>
                            <li><a href="javascript:;">Privacy</a></li>
                            <li><a href="javascript:;">Terms</a></li>
                            <li><a href="javascript:;">Complaints</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="footer-widget-9">
                        <h5 class="mb-3 fw-bold">Follow Us</h5>
                        <div class="social-link d-flex align-items-center gap-2">
                            <a href="javascript:;"><i class="bi bi-facebook"></i></a>
                            <a href="javascript:;"><i class="bi bi-twitter"></i></a>
                            <a href="javascript:;"><i class="bi bi-linkedin"></i></a>
                            <a href="javascript:;"><i class="bi bi-youtube"></i></a>
                            <a href="javascript:;"><i class="bi bi-instagram"></i></a>
                        </div>
                        <div class="mb-3 mt-3">
                            <h5 class="mb-0 fw-bold">Support</h5>
                            <p class="mb-0 text-muted">grabme.co@gmail.com</p>
                        </div>
                        <div class="">
                            <h5 class="mb-0 fw-bold">Toll Free</h5>
                            <p class="mb-0 text-muted">0000-0000-0000</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
            <div class="my-5"></div>
            {{-- <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h5 class="fw-bold mb-3">Download Mobile App</h5>
                    </div>
                    <div
                        class="app-icon d-flex flex-column flex-sm-row align-items-center justify-content-center gap-2">
                        <div>
                            <a href="javascript:;">
                                <img src="{{ asset('frontend/assets/images/play-store.webp') }}" width="160"
                                    alt="">
                            </a>
                        </div>
                        <div>
                            <a href="javascript:;">
                                <img src="{{ asset('frontend/assets/images/apple-store.webp') }}" width="160"
                                    alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!--end row-->

        </div>
    </section>
    <!--end footer-->

    <footer class="footer-strip text-center py-3 bg-section-2 border-top positon-absolute bottom-0">
        <p class="mb-0 text-muted">© 2023. grabme.co@gmail.com | All rights reserved.</p>
    </footer>


    <!--start quick view-->

    <!-- Modal -->
    <div class="modal fade" id="QuickViewModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-0">

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-xl-6">

                            <div class="wrap-modal-slider">

                                <div class="slider-for">
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/product-images/01.jpg') }}"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/product-images/02.jpg') }}"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/product-images/03.jpg') }}"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/product-images/04.jpg') }}"
                                            alt="" class="img-fluid">
                                    </div>
                                </div>

                                <div class="slider-nav mt-3">
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/product-images/01.jpg') }}"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/product-images/02.jpg') }}"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/product-images/03.jpg') }}"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/product-images/04.jpg') }}"
                                            alt="" class="img-fluid">
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="product-info">
                                <h4 class="product-title fw-bold mb-1">Check Pink Kurta</h4>
                                <p class="mb-0">Women Pink & Off-White Printed Kurta with Palazzos</p>
                                <div class="product-rating">
                                    <div class="hstack gap-2 border p-1 mt-3 width-content">
                                        <div><span class="rating-number">4.8</span><i
                                                class="bi bi-star-fill ms-1 text-success"></i></div>
                                        <div class="vr"></div>
                                        <div>162 Ratings</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="product-price d-flex align-items-center gap-3">
                                    <div class="h4 fw-bold">$458</div>
                                    <div class="h5 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h4 fw-bold text-danger">(70% off)</div>
                                </div>
                                <p class="fw-bold mb-0 mt-1 text-success">inclusive of all taxes</p>

                                <div class="more-colors mt-3">
                                    <h6 class="fw-bold mb-3">More Colors</h6>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <div class="color-box bg-red"></div>
                                        <div class="color-box bg-primary"></div>
                                        <div class="color-box bg-yellow"></div>
                                        <div class="color-box bg-purple"></div>
                                        <div class="color-box bg-green"></div>
                                    </div>
                                </div>

                                <div class="size-chart mt-3">
                                    <h6 class="fw-bold mb-3">Select Size</h6>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <div class="">
                                            <button type="button" class="rounded-0">XS</button>
                                        </div>
                                        <div class="">
                                            <button type="button" class="rounded-0">S</button>
                                        </div>
                                        <div class="">
                                            <button type="button" class="rounded-0">M</button>
                                        </div>
                                        <div class="">
                                            <button type="button" class="rounded-0">L</button>
                                        </div>
                                        <div class="">
                                            <button type="button" class="rounded-0">XL</button>
                                        </div>
                                        <div class="">
                                            <button type="button" class="rounded-0">XXL</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-buttons mt-3">
                                    <div class="buttons d-flex flex-column gap-3 mt-4">
                                        <a href="javascript:;"
                                            class="btn btn-lg btn-dark btn-ecomm px-5 py-3 flex-grow-1"><i
                                                class="bi bi-basket2 me-2"></i>Add to Bag</a>
                                        <a href="javascript:;"
                                            class="btn btn-lg btn-outline-dark btn-ecomm px-5 py-3"><i
                                                class="bi bi-suit-heart me-2"></i>Wishlist</a>
                                    </div>
                                </div>
                                <hr class="my-3">
                                <div class="product-share">
                                    <h6 class="fw-bold mb-3">Share This Product</h6>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <div class="">
                                            <button type="button" class="btn-social bg-twitter"><i
                                                    class="bi bi-twitter"></i></button>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn-social bg-facebook"><i
                                                    class="bi bi-facebook"></i></button>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn-social bg-linkden"><i
                                                    class="bi bi-linkedin"></i></button>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn-social bg-youtube"><i
                                                    class="bi bi-youtube"></i></button>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn-social bg-pinterest"><i
                                                    class="bi bi-pinterest"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>

            </div>
        </div>
    </div>
    <!--end quick view-->


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
