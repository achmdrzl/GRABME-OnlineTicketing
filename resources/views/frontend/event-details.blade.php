@extends('frontend.layouts.main')

@section('content')
    <!--start page content-->
    <div class="page-content">


        <!--start breadcrumb-->
        <div class="py-4 border-bottom">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Post</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->


        <!--start product details-->
        <section class="section-padding">
            <div class="container">

                <div class="row g-4">
                    <div class="col-12 col-xl-8">
                        <div class="d-flex flex-column gap-4">
                            <div class="card rounded-0 border">
                                <img src="{{ asset('frontend/assets/images/blog/01.webp') }}"
                                    class="card-img-top rounded-0 mb-3" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-chat me-2"></i>18 Comments</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h4 class="card-title fw-bold mt-3">Blog title here</h4>
                                    <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but
                                        the majority have suffered alteration in some form, by injected humour, or
                                        randomised words which don't look even slightly believable. If you are going to use
                                        a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing
                                        hidden in the middle of text.</p>
                                    <br>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                        suffered alteration in some form, by injected humour, or randomised words which
                                        don't look even slightly believable. If you are going to use a passage of Lorem
                                        Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of
                                        text.</p>
                                    <p>Nullam non felis odio. Praesent aliquam magna est, nec volutpat quam aliquet non.
                                        Cras ut lobortis massa, a fringilla dolor. Quisque ornare est at felis consectetur
                                        mollis. Aliquam vitae metus et enim posuere ornare. Praesent sapien erat,
                                        pellentesque quis sollicitudin eget, imperdiet bibendum magna. Aenean sit amet odio
                                        est.</p>

                                    <div class="d-flex align-items-center gap-3 py-3 border-top border-bottom">
                                        <div class="">
                                            <h5 class="mb-0 fw-bold">Share This Post</h5>
                                        </div>
                                        <div class="footer-widget-9">
                                            <div class="social-link d-flex flex-wrap align-items-center gap-2">
                                                <a href="javascript:;"><i class="bi bi-facebook"></i></a>
                                                <a href="javascript:;"><i class="bi bi-twitter"></i></a>
                                                <a href="javascript:;"><i class="bi bi-linkedin"></i></a>
                                                <a href="javascript:;"><i class="bi bi-youtube"></i></a>
                                                <a href="javascript:;"><i class="bi bi-instagram"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="author d-flex align-items-start gap-3 my-3">
                                        <img src="{{ asset('frontend/assets/images/avatars/01.webp') }}" class=""
                                            alt="" width="80">
                                        <div class="">
                                            <h6 class="mb-0">Jhon Doe</h6>
                                            <p class="mb-0">Donec egestas metus non vehicula accumsan. Pellentesque sit
                                                amet tempor nibh. Mauris in risus lorem. Cras malesuada gravida massa eget
                                                viverra.</p>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card rounded-0 mb-3">
                            <div class="card-body">
                                <h5 class="fw-bold mb-4">Kategori Tiket</h5>
                                <div class="hstack align-items-center justify-content-between">
                                    <p class="mb-0">Bronze</p>
                                    <p class="mb-0">Rp. 250.000</p>
                                    <div class="hstack align-items-center justify-content-between">
                                        <p class="mb-0 text-success"></p>
                                        <select class="form-select form-select-sm w-10" style="width: 100px" name=""
                                            id="">
                                            <option value="">0</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="hstack align-items-center justify-content-between">
                                    <p class="mb-0">Silver</p>
                                    <p class="mb-0">Rp. 350.000</p>
                                    <div class="hstack align-items-center justify-content-between">
                                        <p class="mb-0 text-success"></p>
                                        <select class="form-select form-select-sm w-10" style="width: 100px" name=""
                                            id="">
                                            <option value="">0</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="hstack align-items-center justify-content-between">
                                    <p class="mb-0">Gold</p>
                                    <p class="mb-0">Rp. 4.500.000</p>
                                    <div class="hstack align-items-center justify-content-between">
                                        <p class="mb-0 text-success"></p>
                                        <select class="form-select form-select-sm w-10" style="width: 100px" name=""
                                            id="">
                                            <option value="">0</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="hstack align-items-center justify-content-between fw-bold text-content">
                                    <p class="mb-0">Total Amount</p>
                                    <p class="mb-0">$393.00</p>
                                </div>
                                <div class="d-grid mt-4">
                                    <button type="button" class="btn btn-dark btn-ecomm py-3 px-5">Continue</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end row-->

            </div>
        </section>
        <!--start product details-->


    </div>
    <!--end page content-->
@endsection
