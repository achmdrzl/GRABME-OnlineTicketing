@extends('frontend.layouts.main')

@section('content')
    <div class="page-content">

        <!--start carousel-->
        <section class="slider-section">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active bg-primary">
                        <div class="row d-flex align-items-center">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="h3 fw-light text-white fw-bold">New Arrival</h3>
                                    <h1 class="h1 text-white fw-bold">Women Fashion</h1>
                                    <p class="text-white fw-bold"><i>Last call for upto 25%</i></p>
                                    <div class=""><a class="btn btn-dark btn-ecomm" href="shop-grid.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('frontend/assets/images/sliders/s_1.webp') }}" class="img-fluid"
                                    alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item bg-red">
                        <div class="row d-flex align-items-center">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="h3 fw-light text-white fw-bold">Latest Trending</h3>
                                    <h1 class="h1 text-white fw-bold">Fashion Wear</h1>
                                    <p class="text-white fw-bold"><i>Last call for upto 35%</i></p>
                                    <div class=""> <a class="btn btn-dark btn-ecomm" href="shop-grid.html">Shop
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('frontend/assets/images/sliders/s_2.webp') }}" class="img-fluid"
                                    alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item bg-purple">
                        <div class="row d-flex align-items-center">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="h3 fw-light text-white fw-bold">New Trending</h3>
                                    <h1 class="h1 text-white fw-bold">Kids Fashion</h1>
                                    <p class="text-white fw-bold"><i>Last call for upto 15%</i></p>
                                    <div class=""><a class="btn btn-dark btn-ecomm" href="shop-grid.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('frontend/assets/images/sliders/s_3.webp') }}" class="img-fluid"
                                    alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item bg-yellow">
                        <div class="row d-flex align-items-center">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="h3 fw-light text-dark fw-bold">Latest Trending</h3>
                                    <h1 class="h1 text-dark fw-bold">Electronics Items</h1>
                                    <p class="text-dark fw-bold"><i>Last call for upto 45%</i></p>
                                    <div class=""><a class="btn btn-dark btn-ecomm" href="shop-grid.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('frontend/assets/images/sliders/s_4.webp') }}" class="img-fluid"
                                    alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item bg-green">
                        <div class="row d-flex align-items-center">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="h3 fw-light text-white fw-bold">Super Deals</h3>
                                    <h1 class="h1 text-white fw-bold">Home Furniture</h1>
                                    <p class="text-white fw-bold"><i>Last call for upto 24%</i></p>
                                    <div class=""><a class="btn btn-dark btn-ecomm" href="shop-grid.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('frontend/assets/images/sliders/s_5.webp') }}" class="img-fluid"
                                    alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <!--end carousel-->

        <!--start blog-->
        <section class="section-padding">
            <div class="container">
                <div class="text-center pb-3">
                    <h3 class="mb-0 fw-bold">Event yang paling popuer</h3>
                    <p class="mb-0">Cari event yang sesuai dengan kamu, and lets have some fun with it!</p>
                </div>
                <div class="blog-cards">
                    <div class="row row-cols-1 row-cols-lg-4 g-4">
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset('frontend/assets/images/blog/01.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset('frontend/assets/images/blog/02.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="ribban">Rp. 250.000</div>
                                <img src="{{ asset('frontend/assets/images/blog/03.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset('frontend/assets/images/blog/03.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset('frontend/assets/images/blog/01.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset('frontend/assets/images/blog/02.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="ribban">Rp. 250.000</div>
                                <img src="{{ asset('frontend/assets/images/blog/03.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset('frontend/assets/images/blog/03.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset('frontend/assets/images/blog/01.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset('frontend/assets/images/blog/02.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="ribban">Rp. 250.000</div>
                                <img src="{{ asset('frontend/assets/images/blog/03.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset('frontend/assets/images/blog/03.webp') }}"
                                    class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                    <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                    <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </section>
        <!--end blog-->

        
        <div class="text-center justify-content-between mb-4">
            <button class="btn btn-dark">Load More</button>
        </div>

        <!--subscribe banner-->
        <section class="product-thumb-slider subscribe-banner p-5">
            <div class="row">
                <div class="col-12 col-lg-6 mx-auto">
                    <div class="text-center">
                        <h3 class="mb-0 fw-bold text-white">Get Latest Update by <br> Subscribe Our Newslater</h3>
                        <div class="mt-3">
                            <input type="text"
                                class="form-control form-control-lg bubscribe-control rounded-0 px-5 py-3"
                                placeholder="Enter your email">
                        </div>
                        <div class="mt-3 d-grid">
                            <button type="button"
                                class="btn btn-lg btn-ecomm bubscribe-button px-5 py-3">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--subscribe banner-->

    </div>
@endsection
