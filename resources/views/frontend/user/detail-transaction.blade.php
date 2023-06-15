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
                        <li class="breadcrumb-item"><a href="{{ route('history.index') }}">Transaction</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!--end breadcrumb-->
        <!--start product details-->
        <section class="section-padding">
            <div class="container">
                @if ($data->status_payment == 'expire')
                    <div class="alert alert-danger"><i class="bi bi-info-circle-fill"></i> Sorry, Your Payment Expired!
                    </div>
                @elseif($data->status_payment == 'cancel')
                    <div class="alert alert-danger"><i class="bi bi-info-circle-fill"></i> Sorry, You Has Been Canceled the
                        Order!
                    </div>
                @elseif($data->status_payment == 'pending')
                    <div class="alert alert-warning"><i class="bi bi-info-circle-fill"></i> We Are Waiting For Your Payment!
                    </div>
                @elseif($data->status_payment == 'settlement')
                    <div class="alert alert-success"><i class="bi bi-info-circle-fill"></i> Here you go, thanks for
                        believing in us!
                    </div>
                @endif
                <div class="d-flex align-items-center px-3 py-2 border mb-4">
                    <div class="text-start">
                        <h4 class="mb-0 h4 fw-bold">Transaction Details</h4>
                    </div>
                </div>
                @if ($data->status_payment == 'pending')
                    <div class="d-flex alert alert-danger align-items-center px-3 py-2 mb-4">
                        <div class="text-start">
                            <p class="mb-0 fw-bold">Complete your payment before : </p>
                        </div>
                        <div class="text-start">
                            <strong><span id="timer">00:00:00</span></strong>
                        </div>
                    </div>
                @endif
                <div class="row g-4">
                    <div class="col-12 col-md-12 col-xl-12">
                        <div class="card rounded-0 mb-3">
                            <div class="card-body">
                                <div class="hstack align-items-center justify-content-between">
                                    <p class="mb-0">Order code</p>
                                    <p class="mb-0">{{ Str::limit($data->order_id, 15) }}</p>
                                </div>
                                <hr>
                                <div class="hstack align-items-center justify-content-between">
                                    <p class="mb-0">Payment Type</p>
                                    <p class="mb-0">
                                        {{ $data->payment_type == 'bank_transfer' ? 'Bank Transfer' : 'E-wallet' }}</p>
                                </div>
                                <hr>
                                @if ($data->status_payment == 'pending' && $data->payment_type == 'bank_transfer')
                                    <div class="hstack align-items-center justify-content-between">
                                        <p class="mb-0">Bank</p>
                                        <p class="mb-0">{{ ucfirst($data->bank) }}</p>
                                    </div>
                                    <hr>
                                    <div class="hstack align-items-center justify-content-between">
                                        <p class="mb-0">Va Number</p>
                                        <p class="mb-0">{{ $data->va_number }}</p>
                                    </div>
                                    <hr>
                                @endif
                                <div class="hstack align-items-center justify-content-between">
                                    <p class="mb-0">Buy at</p>
                                    <p class="mb-0">{{ date('d F Y', strtotime($data->created_at)) }},
                                        {{ $data->created_at->format('g:i A') }}
                                    </p>
                                </div>
                                <hr>
                                <div class="hstack align-items-center justify-content-between">
                                    <p class="mb-0">Name</p>
                                    <p class="mb-0">{{ ucfirst($data->user->name) }}</p>
                                </div>
                                <hr>
                                <div class="hstack align-items-center justify-content-between">
                                    <p class="mb-0">Email</p>
                                    <p class="mb-0">{{ ucfirst($data->user->email) }}</p>
                                </div>
                                <hr>
                                <div class="hstack align-items-center justify-content-between">
                                    <p class="mb-0">Phone Number</p>
                                    <p class="mb-0">{{ ucfirst($data->user->phone_number) }}</p>
                                </div>
                                <hr>
                                 <div class="hstack align-items-center justify-content-between">
                                    <p class="mb-0">Name Event</p>
                                    <p class="mb-0">{{ ucfirst($data->event->event_name) }}</p>
                                </div>
                                <hr>
                                <div class="justify-content-between mx-auto">
                                    <p class="mb-3 text-center" style="border-bottom:1px"><strong>Ticket
                                            Details</strong></p>
                                    @foreach ($data->transaksiDetail as $item)
                                        <div class="hstack align-items-center justify-content-between">
                                            <p class="mb-0">
                                                <strong>{{ $item->ticketCategory->ticket_category_name }}</strong> x
                                                {{ $item->amount_ticket }} | Rp. {{ number_format($item->total_ticket) }}
                                            </p>
                                            <p class="mb-0">
                                                Rp.
                                                {{ number_format($item->amount_ticket * $item->total_ticket - $data->internet_tax) }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="hstack align-items-center justify-content-between text-content">
                                    <p class="mb-0">Total Ticket</p>
                                    <p class="mb-0" id="totalPayment">Rp
                                        {{ number_format($data->total_payment - $data->internet_tax) }}</p>
                                </div>
                                <hr>
                                <div class="hstack align-items-center justify-content-between text-content">
                                    <p class="mb-0">Internet Tax</p>
                                    <p class="mb-0" id="totalPayment">Rp {{ number_format($data->internet_tax) }}</p>
                                </div>
                                <hr>
                                <div class="hstack align-items-center justify-content-between fw-bold text-content">
                                    <p class="mb-0">Total Payment</p>
                                    <p class="mb-0" id="totalPayment">Rp {{ number_format($data->total_payment) }}</p>
                                </div>
                                @if ($data->status_payment == 'expire')
                                @elseif($data->status_payment == 'cancel')

                                @elseif($data->status_payment == 'settlement')
                                    <div class="d-grid mt-4">
                                        <button type="button" id="etiket" data-id="{{ $data->order_id }}"
                                            class="btn btn-dark btn-ecomm py-3 px-5">Download E-Ticket</button>
                                    </div>
                                @elseif($data->status_payment == 'pending')
                                    <div class="d-grid mt-4">
                                        {{-- <button type="button" id="pay"
                                            class="btn btn-dark btn-ecomm py-3 px-5">Pay</button> --}}
                                        <button type="button" class="btn btn-danger btn-ecomm py-3 px-5 mt-3"
                                            id="cancelOrder">Cancel
                                            Order</button>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <!--end row-->
            </div>
    </div>
    </section>
    <!--start product details-->

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

            $('body').on('click', '#cancelOrder', function() {

                var order_id = `{{ $data->order_id }}`

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger me-2",
                    },
                    buttonsStyling: false,

                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Do you want to cancel, this order?",
                        text: "This data will be canceled!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "me-2",
                        cancelButtonText: "No",
                        confirmButtonText: "Yes",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('cancel.order') }}",
                                data: {
                                    order_id: order_id,
                                },
                                dataType: "json",
                                success: function(response) {
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
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire("Cancel!", "Not so!", "error");
                        }
                    });

            });

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

            // Mengambil elemen HTML yang akan menampilkan waktu berjalan
            const timerElement = document.getElementById('timer');

            // Tanggal dan waktu saat ini
            const currentDateTime = new Date();

            // Tanggal dan waktu saat pembayaran dibuat (misalnya dari database)
            const paymentDateTime = new Date(`{{ $data->expiry_time }}`);;

            // Menghitung selisih waktu antara pembayaran dan waktu saat ini
            let timeDiff = Math.abs(currentDateTime - paymentDateTime);

            // Mengonversi selisih waktu menjadi detik
            const elapsedSeconds = Math.floor(timeDiff / 1000);

            // Fungsi untuk mengubah detik menjadi format waktu (HH:MM:SS)
            function formatTime(seconds) {
                const isNegative = seconds < 0;
                const absoluteSeconds = Math.abs(seconds);

                const hours = Math.floor(absoluteSeconds / 3600);
                const minutes = Math.floor((absoluteSeconds % 3600) / 60);
                const remainingSeconds = absoluteSeconds % 60;

                const formattedHours = hours.toString().padStart(2, '0');
                const formattedMinutes = minutes.toString().padStart(2, '0');
                const formattedSeconds = remainingSeconds.toString().padStart(2, '0');

                return (isNegative ? '' : '') + `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
            }

            // Update waktu berjalan setiap detik
            setInterval(() => {
                const updatedTimeDiff = new Date() - paymentDateTime;
                const updatedElapsedSeconds = Math.floor(updatedTimeDiff / 1000);
                timerElement.textContent = formatTime(updatedElapsedSeconds);
            }, 1000);

        });
    </script>
@endpush
