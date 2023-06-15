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
                    {{-- <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5"></button> --}}
                </div>
                @php($random1 = rand(0, count($event) - 1))
                @php($random2 = rand(0, count($event) - 1))
                @php($random3 = rand(0, count($event) - 1))
                @php($random4 = rand(0, count($event) - 1))
                @php($random5 = rand(0, count($event) - 1))
                <div class="carousel-inner">
                    <div class="carousel-item active bg-primary">
                        <div class="row d-flex align-items-center">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="h3 fw-light text-white fw-bold">New Event</h3>
                                    <h1 class="h1 text-white fw-bold">{{ ucfirst($event[$random1]->event_name) }}</h1>
                                    <p class="text-white fw-bold">
                                        <i>{{ date('d F Y', strtotime($event[$random1]->date_held)) }}</i></p>
                                    <div class=""><a class="btn btn-dark btn-ecomm"
                                            href="{{ route('event.details', $event[$random1]->slug) }}">Check it out</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('storage/event_poster/' . $event[$random1]->event_poster) }}"
                                    class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="carousel-item bg-yellow" style="height: 420px">
                        <div class="row d-flex align-items-center" style="margin-top: 130px">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="fw-light text-white fw-bold">Punya Kendala Transaksi?</h3>
                                    <p class="text-white fw-bold"><i>segera hubungi tim grabme.co agar <br> kendalamu bisa
                                            segera teratasi.</i></p>
                                    <div class=""><a class="btn btn-dark btn-ecomm" href="">Hubungi Customer
                                            Care</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('frontend/assets/images/cs-png.png') }}"
                                    class="img-fluid" alt="..." width="84%">
                            </div>
                        </div>
                    </div> --}}
                    <div class="carousel-item bg-red">
                        <div class="row d-flex align-items-center">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="h3 fw-light text-white fw-bold">Latest Trending Event</h3>
                                    <h1 class="h1 text-white fw-bold">{{ ucfirst($event[$random2]->event_name) }}</h1>
                                    <p class="text-white fw-bold">
                                        <i>{{ date('d F Y', strtotime($event[$random2]->date_held)) }}</i></p>
                                    <div class=""> <a class="btn btn-dark btn-ecomm"
                                            href="{{ route('event.details', $event[$random2]->slug) }}">Check it
                                            out</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('storage/event_poster/' . $event[$random2]->event_poster) }}"
                                    class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item bg-purple">
                        <div class="row d-flex align-items-center">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="h3 fw-light text-white fw-bold">New Trending Event</h3>
                                    <h1 class="h1 text-white fw-bold">{{ ucfirst($event[$random3]->event_name) }}</h1>
                                    <p class="text-white fw-bold">
                                        <i>{{ date('d F Y', strtotime($event[$random3]->date_held)) }}</i></p>
                                    <div class=""><a class="btn btn-dark btn-ecomm"
                                            href="{{ route('event.details', $event[$random3]->slug) }}">Check it
                                            out</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('storage/event_poster/' . $event[$random3]->event_poster) }}"
                                    class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item bg-yellow">
                        <div class="row d-flex align-items-center">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="h3 fw-light text-dark fw-bold">Latest Trending Event</h3>
                                    <h1 class="h1 text-dark fw-bold">{{ ucfirst($event[$random4]->event_name) }}</h1>
                                    <p class="text-dark fw-bold">
                                        <i>{{ date('d F Y', strtotime($event[$random4]->date_held)) }}</i></p>
                                    <div class=""><a class="btn btn-dark btn-ecomm"
                                            href="{{ route('event.details', $event[$random4]->slug) }}">Check it
                                            out</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('storage/event_poster/' . $event[$random4]->event_poster) }}"
                                    class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item bg-green">
                        <div class="row d-flex align-items-center">
                            <div class="col d-none d-lg-flex justify-content-center">
                                <div class="">
                                    <h3 class="h3 fw-light text-white fw-bold">Super Trending Event</h3>
                                    <h1 class="h1 text-white fw-bold">{{ ucfirst($event[$random5]->event_name) }}</h1>
                                    <p class="text-white fw-bold">
                                        <i>{{ date('d F Y', strtotime($event[$random5]->date_held)) }}</i></p>
                                    <div class=""><a class="btn btn-dark btn-ecomm"
                                            href="{{ route('event.details', $event[$random5]->slug) }}">Check it
                                            out!</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="{{ asset('storage/event_poster/' . $event[$random5]->event_poster) }}"
                                    class="img-fluid" alt="...">
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
                    <h3 class="mb-0 fw-bold">The most popular event</h3>
                    <p class="mb-0">Find an event that suits you, and lets have some fun with it!</p>
                </div>
                <div class="blog-cards">
                    <div class="row row-cols-1 row-cols-lg-4 g-5">
                        @foreach ($event as $item)
                            <div class="col">
                                <div class="card">
                                    <img src="{{ asset('storage/event_poster/' . $item->event_poster) }}"
                                        class="card-img-top rounded-0" alt="...">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-4">
                                            <div class="posted-by">
                                                <p class="mb-0"><i
                                                        class="bi bi-person me-1"></i>{{ ucfirst($item->user->name) }}</p>
                                            </div>
                                            <div class="posted-date">
                                                <p class="mb-0"><i
                                                        class="bi bi-calendar me-2"></i>{{ date('d F Y', strtotime($item->date_held)) }}
                                                </p>
                                            </div>
                                        </div>
                                        <h5 class="card-title fw-bold mt-3">{{ ucfirst($item->event_name) }}</h5>
                                        <p class="mb-0">{{ Str::limit(strip_tags($item->event_description), 60) }}</p>
                                        <a href="{{ route('event.details', $item->slug) }}"
                                            class="btn btn-outline-dark btn-ecomm mt-3">Check it
                                            out</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--end row-->
                </div>
            </div>
        </section>
        <!--end blog-->


        <div class="text-center justify-content-between mb-4">
            <button class="btn btn-dark btn-ecomm">Load More</button>
        </div>

    </div>
@endsection
