    <!--start top header-->
    <header class="top-header">
        <nav class="navbar navbar-expand-xl w-100 sticky-top navbar-dark container gap-3">
            <a class="navbar-brand d-none d-xl-inline" href="{{ route('index') }}"><img
                    src="{{ asset('frontend/assets/images/grabme.png') }}" class="logo-img" alt=""></a>
            <a class="mobile-menu-btn d-inline d-xl-none" href="{{ route('index') }}">
                <img src="{{ asset('frontend/assets/images/grabme.png') }}" class="logo-img" alt="">
                {{-- <i class="bi bi-list"></i> --}}
            </a>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
                {{-- <div class="offcanvas-header">
                    <div class="offcanvas-logo"><img src="{{ asset('frontend/assets/images/logo.webp') }}"
                            class="logo-img" alt="">
                    </div>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body primary-menu">
                    <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="tv-shows.html"
                                data-bs-toggle="dropdown">
                                Categories
                            </a>
                            <div class="dropdown-menu dropdown-large-menu">
                                <div class="row">
                                    <div class="col-12 col-xl-4">
                                        <h6 class="large-menu-title">Fashion</h6>
                                        <ul class="list-unstyled">
                                            <li><a href="javascript:;">Casual T-Shirts</a>
                                            </li>
                                            <li><a href="javascript:;">Formal Shirts</a>
                                            </li>
                                            <li><a href="javascript:;">Jackets</a>
                                            </li>
                                            <li><a href="javascript:;">Jeans</a>
                                            </li>
                                            <li><a href="javascript:;">Dresses</a>
                                            </li>
                                            <li><a href="javascript:;">Sneakers</a>
                                            </li>
                                            <li><a href="javascript:;">Belts</a>
                                            </li>
                                            <li><a href="javascript:;">Sports Shoes</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end col-3 -->
                                    <div class="col-12 col-xl-4">
                                        <h6 class="large-menu-title">Electronics</h6>
                                        <ul class="list-unstyled">
                                            <li><a href="javascript:;">Mobiles</a>
                                            </li>
                                            <li><a href="javascript:;">Laptops</a>
                                            </li>
                                            <li><a href="javascript:;">Macbook</a>
                                            </li>
                                            <li><a href="javascript:;">Televisions</a>
                                            </li>
                                            <li><a href="javascript:;">Lighting</a>
                                            </li>
                                            <li><a href="javascript:;">Smart Watch</a>
                                            </li>
                                            <li><a href="javascript:;">Galaxy Phones</a>
                                            </li>
                                            <li><a href="javascript:;">PC Monitors</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end col-3 -->
                                    <div class="col-12 col-xl-4 d-none d-xl-block">
                                        <div class="pramotion-banner1">
                                            <img src="{{ asset('frontend/assets/images/menu-img.webp') }}"
                                                class="img-fluid" alt="" />
                                        </div>
                                    </div>
                                    <!-- end col-3 -->
                                </div>
                                <!-- end row -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                data-bs-toggle="dropdown">
                                Shop
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="cart.html">Shop Cart</a></li>
                                <li><a class="dropdown-item" href="wishlist.html">Wishlist</a></li>
                                <li><a class="dropdown-item" href="product-details.html">Product Details</a></li>
                                <li><a class="dropdown-item" href="payment-method.html">Payment Method</a></li>
                                <li><a class="dropdown-item" href="billing-details.html">Billing Details</a></li>
                                <li><a class="dropdown-item" href="address.html">Addresses</a></li>
                                <li><a class="dropdown-item" href="shop-grid.html">Shop Grid</a></li>
                                <li><a class="dropdown-item" href="shop-grid-type-4.html">Shop Grid 4</a></li>
                                <li><a class="dropdown-item" href="shop-grid-type-5.html">Shop Grid 5</a></li>
                                <li><a class="dropdown-item" href="search.html">Search</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about-us.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact-us.html">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                data-bs-toggle="dropdown">
                                Account
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="account-dashboard.html">Dashboard</a></li>
                                <li><a class="dropdown-item" href="account-orders.html">My Orders</a></li>
                                <li><a class="dropdown-item" href="account-profile.html">My Profile</a></li>
                                <li><a class="dropdown-item" href="account-edit-profile.html">Edit Profile</a></li>
                                <li><a class="dropdown-item" href="account-saved-address.html">Addresses</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="authentication-login.html">Login</a></li>
                                <li><a class="dropdown-item" href="authentication-register.html">Register</a></li>
                                <li><a class="dropdown-item" href="authentication-reset-password.html">Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                data-bs-toggle="dropdown">
                                Blog
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="blog-post.html">Blog Post</a></li>
                                <li><a class="dropdown-item" href="blog-read.html">Blog Read</a></li>
                            </ul>
                        </li>
                    </ul>
                </div> --}}
            </div>
            <ul class="navbar-nav secondary-menu flex-row">
                <li class="nav-item me-3">
                    <a class="nav-link dark-mode-icon" href="javascript:;">
                        <div class="mode-icon">
                            <i class="bi bi-moon"></i>
                        </div>
                    </a>
                </li>
                {{-- <li class="nav-item me-4">
                    <a class="nav-link" href="wishlist.html"><i class="bi bi-cash-stack"></i></a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="wishlist.html"><i class="bi bi-suit-heart"></i></a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="search.html"><i class="bi bi-search"></i></a>
                </li> --}}
                {{-- <li class="nav-item" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                    <a class="nav-link position-relative" href="javascript:;">
                        <div class="cart-badge">8</div>
                        <i class="bi bi-basket2"></i>
                    </a>
                </li> --}}
                <div class="divider"></div>
                @if(Auth::user() == true)
                <li class="nav-item me-3">
                    <a class="nav-link" href="{{ route('history.index') }}"><i class="bi bi-ticket-perforated"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.user') }}"><i class="bi bi-person-circle"></i></a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}" style="font-size: 15px;">Login/Register</a>
                </li>
                @endif
            </ul>
        </nav>
    </header>
    <!--end top header-->
