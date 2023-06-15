@extends('backend.layouts.main')

@push('style-alt')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End plugin css for this page -->

    <style>
        #showTransaction .modal-body {
            overflow-y: auto;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Event Data Transaction</a></li>
                <li class="breadcrumb-item active" aria-current="page">Event Transaction</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Event Data Transaction Events</h6>
                        <p class="text-muted mb-3">Detail from transaction events.</p>
                        <div class="table-responsive">
                            <table id="event-datatable" class="table w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Event</th>
                                        <th>Date Held</th>
                                        <th>Event Location</th>
                                        <th>Status Event</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


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
            var table = $('#event-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('transaction.event') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'event_name',
                        name: 'event_name'
                    },
                    {
                        data: 'date_held',
                        name: 'date_held'
                    },
                    {
                        data: 'event_location',
                        name: 'event_location'
                    },
                    {
                        data: 'event_status',
                        name: 'event_status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            const rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }

            $('body').on('click', '#event-show', function() {
                var slug = $(this).attr('data-id');
                console.log(slug)
                $.ajax({
                    type: "POST",
                    url: "{{ route('get.transaction.data') }}",
                    data: {
                        slug: slug
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        window.open('/transactionShow/' + slug);
                    }
                });
            });
        });
    </script>
@endpush
