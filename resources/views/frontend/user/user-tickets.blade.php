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
                        <li class="breadcrumb-item active" aria-current="page">Tickets</li>
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
                        <h4 class="mb-0 h4 fw-bold">Account - Tickets</h4>
                    </div>
                </div>
                <div class="btn btn-dark btn-ecomm d-xl-none position-fixed top-50 start-0 translate-middle-y"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarFilter"><span><i
                            class="bi bi-person me-2"></i>Account</span></div>
                <div class="row">
                    <div class="col-md-12 col-xl-3 filter-column">
                        <nav class="navbar navbar-expand-xl flex-wrap p-0">
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbarFilter"
                                aria-labelledby="offcanvasNavbarFilterLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title mb-0 fw-bold text-uppercase" id="offcanvasNavbarFilterLabel">
                                        Tickets</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body account-menu">
                                    <div class="list-group w-100 rounded-0">
                                        <a href="{{ route('dashboard.user') }}" class="list-group-item"><i
                                                class="bi bi-pencil me-2"></i>Profile</a>
                                        <a href="{{ route('ticket.index') }}" class="list-group-item active"><i
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
                    <div class="col-12 col-xl-9 col-md-12">

                        <div class="card rounded-0 mb-3 bg-light">
                            <div class="card-body">
                                <div class="d-flex flex-column flex-xl-row gap-3 align-items-center">
                                    <div class="">
                                        <h5 class="mb-1 fw-bold">All Transactions</h5>
                                        <p class="mb-0">for anytime</p>
                                    </div>
                                    <div class="order-search flex-grow-1">
                                        <form>
                                            <div class="position-relative">
                                                <input type="text" class="form-control ps-5 rounded-0"
                                                    placeholder="Search Product...">
                                                <span class="position-absolute top-50 product-show translate-middle-y"><i
                                                        class="bi bi-search ms-3"></i></span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="filter">
                                        <button type="button" class="btn btn-dark rounded-0" data-bs-toggle="modal"
                                            data-bs-target="#FilterOrders"><i class="bi bi-filter me-2"></i>Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @forelse($data as $item)
                            <div class="card rounded-0 mb-3">
                                <div class="card-body">
                                    <div class="d-flex flex-column flex-xl-row gap-3">
                                        <div class="product-img align-items-center text-center">
                                            <img class=""
                                                src="{{ asset('storage/public/event_poster/' . $item->event->event_poster) }}"
                                                width="200" alt="">
                                        </div>
                                        <div class="product-info flex-grow-1">
                                            <h5 class="fw-bold mb-0">{{ ucfirst($item->event->event_name) }}</h5>
                                            <div class="product-price d-flex align-items-center gap-2 mt-3">
                                                <div class="h6 fw-light text-muted">Buy at :
                                                    {{ date('d F Y', strtotime($item->created_at)) }},
                                                    {{ $item->created_at->format('g:i A') }}</div>|

                                                <div class="h6 fw-bold">Total Payment : Rp.
                                                    {{ number_format($item->total_payment) }}</div>
                                            </div>
                                            <div class="mt-2 hstack gap-2">
                                                <div class="d-flex">
                                                    <div class="fw-light text-muted">status :
                                                    </div>
                                                </div>
                                                <div class="badge bg-success">
                                                    {{ $item->status_payment == 'settlement' ? 'Success' : '' }}</div>
                                            </div>
                                        </div>
                                        <div class="d-none d-xl-block vr"></div>
                                        <div class="">
                                            <div class="d-grid gap-3 align-items-center">
                                                <button type="button" id="etiket" data-id="{{ $item->order_id }}"
                                                    class="btn btn-dark btn-ecomm">Download
                                                    E-ticket</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card rounded-0 mb-3">
                                <div class="card-body">
                                    <div class="d-flex flex-column flex-xl-row gap-3">
                                        <div class="product-info flex-grow-1">
                                            <h5 class="fw-bold mb-1">Oops, no ticket yet
                                            </h5>
                                            <p class="mb-0">Maybe you took the wrong route or address. Let’s go back
                                                before it gets dark!</p>
                                        </div>
                                        <div class="d-none d-xl-block vr"></div>
                                        <div class="d-grid align-self-start align-self-xl-center">
                                            <a href="{{ route('index') }}" class="btn btn-outline-dark btn-ecomm">Browse
                                                Our Events</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!--end row-->
            </div>
        </section>
        <!--start product details-->


        <!-- filter Modal -->
        <div class="modal" id="FilterOrders" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Filter Orders</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 class="mb-3 fw-bold">Status</h6>
                        <div class="status-radio d-flex flex-column gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    All
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    On the way
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault3">
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Delivered
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault4">
                                <label class="form-check-label" for="flexRadioDefault4">
                                    Cancelled
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault5">
                                <label class="form-check-label" for="flexRadioDefault5">
                                    Returned
                                </label>
                            </div>
                        </div>
                        <hr>
                        <h6 class="mb-3 fw-bold">Time</h6>
                        <div class="status-radio d-flex flex-column gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioTime"
                                    id="flexRadioDefault6" checked>
                                <label class="form-check-label" for="flexRadioDefault6">
                                    Anytime
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioTime"
                                    id="flexRadioDefault7">
                                <label class="form-check-label" for="flexRadioDefault7">
                                    Last 30 days
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioTime"
                                    id="flexRadioDefault8">
                                <label class="form-check-label" for="flexRadioDefault8">
                                    Last 6 months
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioTime"
                                    id="flexRadioDefault9">
                                <label class="form-check-label" for="flexRadioDefault9">
                                    Last year
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="d-flex align-items-center gap-3 w-100">
                            <button type="button" class="btn btn-outline-dark btn-ecomm w-50">Clear Filters</button>
                            <button type="button" class="btn btn-dark btn-ecomm w-50">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Filters Modal -->


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

            $('#etiket').click(function() {
                $(this).html('Sending..');
                var order_id = $(this).attr('data-id');
                $.ajax({
                    url: "/etiket/" + order_id,
                    method: 'GET',
                    dataType: 'binary',
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        var url = window.URL.createObjectURL(new Blob([response]));
                        var link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', order_id + '.pdf');
                        link.click();

                        $("#etiket").html('Download E-ticket')
                    }
                });
            });

        });
    </script>
@endpush
