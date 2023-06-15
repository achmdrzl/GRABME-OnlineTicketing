@extends('backend.layouts.main')

@push('style-alt')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transaction Event</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Transaction of Event</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Transaction Events</h6>
                        <p class="text-muted mb-3">Detail from data events.</p>
                        <div class="table-responsive">
                            <table id="transaction-datatable" class="table w-100">
                                <thead>
                                    <th>No</th>
                                    <th>Order Code</th>
                                    <th>Name Event</th>
                                    <th>Customer</th>
                                    <th>Internet Tax</th>
                                    <th>Total Payment</th>
                                    <th>Status Payment</th>
                                    <th>Status Print</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <h5 class="card-title">Internet Tax : {{ number_format($tax == 0 ? 0 : $tax) }}</h5>
                        <hr>
                        <h5 class="card-title">Transaction : Rp. {{ number_format($total_payment - $tax == 0 ? 0 : $total_payment - $tax) }}</h5>
                        <hr>
                        <h5 class="card-title">Total Transactions : Rp. {{ number_format($total_payment == 0 ? 0 : $total_payment) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Modal Update Status --}}
<div class="modal fade" id="showTransaction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body" style>
                <table id="data-transaction" class="table table-striped">

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('script-alt')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
    <!-- End custom js for this page -->

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Rendering Table
            var table = $('#transaction-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/transactionShow/' + `{{ $id }}`,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'order_id',
                        name: 'order_id'
                    },
                    {
                        data: 'name_event',
                        name: 'name_event'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'internet_tax',
                        name: 'internet_tax'
                    },
                    {
                        data: 'total_payment',
                        name: 'total_payment'
                    },
                    {
                        data: 'status_payment',
                        name: 'status_payment'
                    },
                    {
                        data: 'status_cetak',
                        name: 'status_cetak'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            const rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }

            $('body').on('click', '#transaction-show', function() {
                var tf_id = $(this).attr('data-id');

                $('#modalHeading').html("DETAIL TRANSACTION");
                $('#showTransaction').modal('show');

                $.ajax({
                    type: "POST",
                    url: "{{ route('show.transaction') }}",
                    data: {
                        tf_id: tf_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        var data = '';

                        data += `<tr class="text-center mb-2">
                                    <th colspan="3">Data Customer</th>
                                </tr>
                                <tr>
                                    <td>Name Order</td>
                                    <td>:</td>
                                    <td>` + response.user.name + `</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>` + response.user.email + `</td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>:</td>
                                    <td>` + response.user.phone_number + `</td>
                                </tr>
                                <tr class="text-center mb-2">
                                    <th colspan="3">Data Order</th>
                                </tr>
                                <tr>
                                    <td>Order Code</td>
                                    <td>:</td>
                                    <td>` + response.order_id + `</td>
                                </tr>
                                <tr>
                                    <td>Event Name</td>
                                    <td>:</td>
                                    <td>` + response.event.event_name + `</td>
                                </tr>
                                <tr>
                                    <td>Total Payment</td>
                                    <td>:</td>
                                    <td>` + rupiah(response.total_payment) + `</td>
                                </tr>
                                <tr>
                                    <td>Status Payment</td>
                                    <td>:</td>
                                    <td><div class="badge bg-success">` + response.status_payment + `</div></td>
                                </tr>
                                <tr class="text-center mb-2">
                                    <th colspan="3">Data Order Details</th>
                                </tr>`;
                        var no = 1;
                        $.each(response.transaksi_detail, function(key, value) {
                            const amount_ticket = value['amount_ticket'];
                            const total_ticket = value['total_ticket'];
                            const ticket_category = value.ticket_category[
                                'ticket_category_name'];

                            data += `<tr>
                                        <td>Ticket Category ` + no++ + `</td>
                                        <td>:</td>
                                        <td>` + ticket_category + ` | x` + amount_ticket + ` tickets</td>
                                    </tr>`;
                        });

                        $("#data-transaction").html(data)
                    }
                });
            });

            $('body').on('click', '#tf-update', function() {
                var tf_id = $(this).attr('data-id');

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger me-2",
                    },
                    buttonsStyling: false,

                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Do you want to update, this data?",
                        text: "This data will be updated!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "me-2",
                        cancelButtonText: "Tidak",
                        confirmButtonText: "Ya",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('update.cetak') }}",
                                data: {
                                    tf_id: tf_id,
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
                                    table.draw();
                                }
                            });
                        } else {
                            Swal.fire("Cancel!", "Command canceled!", "error");
                        }
                    });

            });
        });
    </script>
@endpush
