@extends('frontend.layouts.main')

@push('style-alt')
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
                        <li class="breadcrumb-item active" aria-current="page">Transaction History</li>
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
                        <h4 class="mb-0 h4 fw-bold">My Transactions ({{ count($transaction) }} items)</h4>
                    </div>
                    {{-- <div class="ms-auto">
                        <button type="button" class="btn btn-light btn-ecomm">Continue Shopping</button>
                    </div> --}}
                </div>
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
                <div class="row g-4">
                    <div class="col-12 col-xl-12 col-md-12">

                        @forelse($transaction as $item)
                            <div class="card rounded-0 mb-3">
                                <div class="card-body">
                                    <div class="d-flex flex-column flex-lg-row gap-3">
                                        <div class="product-img align-items-center text-center">
                                            <img class=""
                                                src="{{ asset('storage/public/event_poster/' . $item->event->event_poster) }}"
                                                width="250" alt="">
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
                                                @if ($item->status_payment == 'settlement')
                                                    <div class="d-flex">
                                                        <div class="fw-light text-muted">status :
                                                        </div>
                                                    </div>
                                                    <div class="badge bg-success">
                                                        {{ $item->status_payment == 'settlement' ? 'Success' : '' }}</div>
                                                @elseif($item->status_payment == 'pending')
                                                    <div class="d-flex">
                                                        <div class="fw-light text-muted">status :
                                                        </div>
                                                    </div>
                                                    <div class="badge bg-warning text-dark">
                                                        {{ $item->status_payment == 'pending' ? 'Waiting Payment' : '' }}
                                                    </div>
                                                @else
                                                    <div class="d-flex">
                                                        <div class="fw-light text-muted">status :
                                                        </div>
                                                    </div>
                                                    <div class="badge bg-danger">
                                                        {{ $item->status_payment == 'expire' ? 'Expired' : 'Cancel' }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-none d-lg-block vr"></div>
                                        <div class="">
                                            <div class="d-grid gap-2 align-self-start align-self-lg-center">
                                                <a href="{{ route('detail.transaction', $item->order_id) }}"
                                                    class="btn btn-outline-dark btn-ecomm">
                                                    Detail
                                                </a>
                                                @if ($item->status_payment == 'expire' || $item->status_payment == 'cancel' || $item->status_payment == 'settlement')
                                                @else
                                                    {{-- <button type="button" id="continueOrder" data-id="{{ $item->tf_id }}"
                                                        class="btn btn-dark btn-ecomm"><i
                                                            class="bi bi-suit-heart me-2"></i>Pay Now!</button> --}}
                                                @endif
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
                                            <h5 class="fw-bold mb-1">Oops, no transaction yet
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

    </div>
    <!--end page content-->

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
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                                checked>
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
                            <input class="form-check-input" type="radio" name="flexRadioTime" id="flexRadioDefault6"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault6">
                                Anytime
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioTime" id="flexRadioDefault7">
                            <label class="form-check-label" for="flexRadioDefault7">
                                Last 30 days
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioTime" id="flexRadioDefault8">
                            <label class="form-check-label" for="flexRadioDefault8">
                                Last 6 months
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioTime" id="flexRadioDefault9">
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
                    $('#name').val(response.name);
                    $('#email').val(response.email);
                    $('#phone_number').val(response.phone_number);
                    $('#date_birthday').val(response.profile[0].date_birthday);
                    $('#gender').val(response.profile[0].gender);
                    $('#address').val(response.profile[0].address);
                    $('#job').val(response.profile[0].job);
                }
            });

            $('body').on('click', '#continueOrder', function() {
                var tf_id = $(this).attr('data-id');
                $(this).html('Sending..');

                $.ajax({
                    type: "POST",
                    url: "{{ route('continue.order') }}",
                    data: {
                        tf_id: tf_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        window.snap.pay(response.snapToken, {
                            onSuccess: function(result) {
                                /* You may add your own implementation here */
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
                                $('#continueOrder').html('PAY NOW!');

                            },
                            onPending: function(result) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });

                                Toast.fire({
                                    icon: 'success',
                                    title: 'We Are Waiting For Your Payment!',
                                })
                                $('#continueOrder').html('PAY NOW!');

                            },
                            onError: function(result) {
                                /* You may add your own implementation here */
                                Swal.fire("Cancel!",
                                    "Payment error, please do it again!",
                                    "error");
                                $('#continueOrder').html('PAY NOW!');

                            },
                            onClose: function() {
                                /* You may add your own implementation here */
                                Swal.fire("Cancel!", "Payment closed!",
                                    "error");
                                $('#continueOrder').html('PAY NOW!');

                            }
                        })
                    }
                });
            })
        });
    </script>
@endpush
