{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('frontend.layouts.main')

@section('content')
    <div class="page-content">

        <!--start breadcrumb-->
        <div class="py-4 border-bottom">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register</li>
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
                                <h4 class="mb-0 fw-bold text-center">User Register</h4>
                                <hr>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <label for="exampleUsername" class="form-label">Username</label>
                                            <input type="text" id="name" class="form-control rounded-0"
                                                name="name" :value="old('name')" required autofocus
                                                autocomplete="name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <label for="exampleUsername" class="form-label">Email</label>
                                            <input type="email" id="email" class="form-control rounded-0"
                                                name="email" :value="old('email')" required autocomplete="username">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <label for="examplePassword" class="form-label">Password</label>
                                            <input class="form-control rounded-0" id="password" type="password"
                                                name="password" required autocomplete="new-password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <label for="examplePassword" class="form-label">Confirm Password</label>
                                            <input class="form-control rounded-0" id="password_confirmation" type="password"
                                                name="password_confirmation" required autocomplete="new-password">
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <hr class="my-0">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-dark rounded-0 btn-ecomm w-100">Register</button>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="mb-0 rounded-0 w-100">Already registered? <a
                                                    href="{{ route('login') }}" class="text-danger">Sign In</a></p>
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
