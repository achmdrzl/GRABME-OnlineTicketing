@extends('frontend.layouts.main')

@section('content')
    <div class="page-content">

        <!--start breadcrumb-->
        <div class="py-4 border-bottom">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <!--start product details-->
        <section class="section-padding">
            <div class="container">

                <div class="row">
                    <div class="col-12 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                        <div class="card rounded-0">
                            <div class="card-body p-4">
                                <h4 class="mb-0 fw-bold text-center">Forgot Password</h4>
                                <hr>
                                <div class="mb-4 text-sm text-gray-600" style="font-size: 13px">
                                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                </div>
                                <hr>
                                <x-auth-session-status class="mb-2" :status="session('status')" />
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <label for="exampleUsername" class="form-label">Email</label>
                                            <input class="form-control rounded-0" id="email" type="email"
                                                name="email" :value="old('email')" required autofocus>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark rounded-0 btn-ecomm w-100">Forgot
                                                Password</button>
                                        </div>
                                    </div>
                                    <!---end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->

            </div>
        </section>
        <!--start product details-->

        <!--subscribe banner-->
        <section class="product-thumb-slider subscribe-banner p-5">
            <div class="row">
                <div class="col-12 col-lg-6 mx-auto">
                    <div class="text-center">
                        <h3 class="mb-0 fw-bold text-white">Get Latest Update by <br> Subscribe Our Newslater</h3>
                        <div class="mt-3">
                            <input type="text" class="form-control form-control-lg bubscribe-control rounded-0 px-5 py-3"
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
