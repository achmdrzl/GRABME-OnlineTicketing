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
                        <li class="breadcrumb-item active" aria-current="page">Event Detail</li>
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
                                <img src="{{ asset('storage/event_poster/' . $event->event_poster) }}"
                                    class="card-img-top rounded-0 mb-3" alt="...">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="posted-by">
                                            <p class="mb-0"><i
                                                    class="bi bi-person me-2"></i>{{ ucfirst($event->user->name) }}</p>
                                        </div>
                                        <div class="posted-date">
                                            <p class="mb-0"><i
                                                    class="bi bi-calendar me-2"></i>{{ date('d F Y', strtotime($event->date_held)) }}
                                            </p>
                                        </div>
                                    </div>
                                    <h4 class="card-title fw-bold mt-3">{{ ucfirst($event->event_name) }}</h4>
                                    <p class="mb-0">{{ strip_tags($event->event_description) }}</p>
                                    <br>
                                    <div class="d-flex align-items-center gap-3 py-3 border-top border-bottom">
                                        <div class="">
                                            <h5 class="mb-0 fw-bold">Talent Events</h5>
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
                                    @foreach ($event->eventTalent as $item)
                                        <div class="author d-flex align-items-start gap-3 my-3">
                                            <img src="{{ asset('frontend/assets/images/talent.png') }}" class=""
                                                alt="" width="80">
                                            <div class="" style="margin-top:30px">
                                                <h6 class="mb-0"><strong>{{ ucfirst($item->event_talent_name == null ? 'TBA' : $item->event_talent_name) }}</strong>
                                                </h6>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card rounded-0 mb-3">
                            <div class="card-body">
                                <h5 class="fw-bold mb-4">Category Ticket</h5>
                                <form>
                                    <input type="hidden" name="event_id" id="event_id">
                                    <div id="categoryTicket">

                                    </div>
                                    <div class="hstack align-items-center justify-content-between fw-bold text-content">
                                        <p class="mb-0" id="notasi" hidden>Total Amount</p>
                                        <p class="mb-0" id="total" hidden></p>
                                        <input type="hidden" id="totalPrice" name="totalPrice">
                                    </div>
                                    <div class="d-grid mt-4">
                                        <button type="button" id="continueCheckout"
                                            class="btn btn-dark btn-ecomm py-3 px-5" disabled>Continue</button>
                                    </div>
                                </form>
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
                type: "POST",
                url: "{{ route('get.ticketCategory') }}",
                data: {
                    event_id: `{{ $id }}`
                },
                dataType: "JSON",
                success: function(response) {
                    var listCategory = '';
                    console.log(response.length == 0)
                    if (response.length == 0) {
                        listCategory +=
                            `<p class="alert alert-danger">Tickets will be available soon!</p>`;
                    }
                    $.each(response, function(key, value) {
                        const categoryName = value['ticket_category_name'];
                        const price = value['ticket_category_price'];
                        const id = value['ticket_category_id'];
                        console.log('value' + value)


                        if (value['ticket_category_status'] == 'sold out') {
                            listCategory += `<div class="hstack align-items-center justify-content-between">
                                        <p class="mb-0">` + categoryName + `</p>
                                        <h6 class="mb-0">` + rupiah(price) + `</h6>
                                        <div class="hstack align-items-center justify-content-between">
                                            <p class="mb-0 text-danger" style="width: 100px">Sold Out</p>
                                        </div>
                                    </div>
                                    <hr>`;
                        } else if (value['ticket_category_status'] == 'available') {
                            listCategory += `<div class="hstack align-items-center justify-content-between">
                                            <p class="mb-0">` + categoryName + `</p>
                                            <h6 class="mb-0">` + rupiah(price) + `</h6>
                                            <div class="hstack align-items-center justify-content-between">
                                                <p class="mb-0 text-success"></p>
                                                <div id="input-` + id + `">
                                                    <button id="select-` + id + `" data-id=` + id + ` class="btn btn-dark btn-ecomm btnTicket"
                                                        type="button">select</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>`;
                        } else {
                            listCategory += `<div class="hstack align-items-center justify-content-between">
                                            <p class="mb-0">` + categoryName + `</p>
                                            <h6 class="mb-0">coming soon!</h6>
                                            <div class="hstack align-items-center justify-content-between">
                                                <p class="mb-0 text-success"></p>
                                                <div id="input-` + id + `">
                                                    <button id="select-` + id + `" data-id=` + id + ` class="btn btn-dark btn-ecomm btnTicket"
                                                        type="button" disabled>coming soon!</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>`;

                        }
                    });
                    $("#categoryTicket").html(listCategory);
                }
            });

            $('body').on('click', '.btnTicket', function() {
                var id = $(this).attr('data-id');
                $('#select-' + id).remove();
                var input = `<input type="hidden" value="` + id + `" name="ticket_category_id[]" id="ticket_category_id">
                             <select class="form-select form-select-sm w-10 ticket" style="width: 100px"
                                name="amount_ticket[]" id="amount_ticket-` + id + `" data-id=` + id + `>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>`;
                $('#input-' + id).html(input)
                $('#continueCheckout').attr('disabled', false);
            })

            let hasilOnchange = [];
            let data = [];
            $('body').on('change', '.ticket', function() {
                var id = $(this).attr('data-id');
                var amount = $("#amount_ticket-" + id).find(":checked").val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('get.amountPrice') }}",
                    data: {
                        ticket_category_id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        
                        // save while on array data
                        var index = data.findIndex(function(obj) {
                            console.log(obj.id)
                            return obj.id === id;
                        });

                        if (index !== -1) {
                            // If the object was found, replace it with a new object
                            data[index] = {
                                id: id,
                                amount: amount,
                                price: response.ticket_category_price,
                                total: amount * response.ticket_category_price,
                            };
                        } else {
                            data.push({
                                id: id,
                                amount: amount,
                                price: response.ticket_category_price,
                                total: amount * response.ticket_category_price,
                            })
                        }

                        console.log(data)

                        var sum = data.reduce(function(total, currentValue) {
                            return total + currentValue.total;

                        }, 0);
                        console.log(sum)

                        // tampilkan nilai hasilAkhir
                        document.getElementById("notasi").setAttribute("hidden", false);
                        $("#notasi").removeAttr("hidden");
                        document.getElementById("total").setAttribute("hidden", false);
                        $("#total").removeAttr("hidden");

                        $("#total").html(rupiah(sum));
                        $("#totalPrice").val(sum);
                    }
                });
            })

            $('body').on('click', '#continueCheckout', function() {
                $(this).html('Sending..');
                $("#event_id").val(`{{ $id }}`);
                $.ajax({
                    type: "POST",
                    url: "{{ route('checkout.ticket') }}",
                    data: new FormData(this.form),
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        // window.location = '{{ route('confirm.order') }}'
                        if (response.success) {
                            window.location.href = response.redirect_url;
                        } else {
                            // Handle error here
                        }
                        $("#continueCheckout").html('CONTINUE');

                    }
                });
            });
        })
    </script>
@endpush
