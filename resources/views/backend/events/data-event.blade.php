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
                <li class="breadcrumb-item"><a href="#">Data Event</a></li>
                <li class="breadcrumb-item active" aria-current="page">Events</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('event.add') }}">
                            <button class="btn btn-primary user-create float-end" data-bs-toggle="modal"
                                data-bs-target="#userModal">
                                <i class="icon-md" data-feather="plus"></i> Add Data
                            </button>
                        </a>
                        <h6 class="card-title">Data Events</h6>
                        <p class="text-muted mb-3">Detail from data events.</p>
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

{{-- Modal Update Status --}}
<div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;"
                    style="color: red">
                </div>
                <input type="hidden" id="event_id" name="event_id">
                <label for="" class="form-label">Select Status :</label>
                <select name="event_status" id="event_status" class="form-select">
                    <option value="listing">Listing</option>
                    <option value="archive">Archive</option>
                    <option value="publish">Publish</option>
                    <option value="finish">Finish</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitStatus">Save changes</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Update Status --}}
<div class="modal fade bd-example-modal-lg" id="updateStatusCategory" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-responsive-lg" id="table_category" width="100%">
                    <thead>
                        <th>Category No</th>
                        <th>Category Name</th>
                        <th>Category Price</th>
                        <th>Category Quota</th>
                        <th>Category Status</th>
                        <th>Action</th>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitStatus">Save changes</button>
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
            var table = $('#event-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('event.index') }}",
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

            $('body').on('click', '#event-show', function() {
                var event_id = $(this).attr('data-id');
                console.log(event_id)
                $.ajax({
                    type: "POST",
                    url: "{{ route('get.event.data') }}",
                    data: {
                        event_id: event_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        window.open('/event/show/' + response.event_id);
                    }
                });
            });

            $('body').on('click', '#event-edit', function() {
                var event_id = $(this).attr('data-id');
                console.log(event_id)
                $.ajax({
                    type: "POST",
                    url: "{{ route('get.event.data') }}",
                    data: {
                        event_id: event_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        window.open('/event/edit/' + response.event_id);
                    }
                });
            });

            // Update Status Event.
            $('body').on('click', '#event-update', function() {
                var event_id = $(this).attr('data-id');
                const sel = document.getElementById("event_status");
                $('#submitBtn').val("update status event");
                $('#modalHeading').html("UPDATE EVENT STATUS");
                $('#updateStatus').modal('show');
                $.ajax({
                    type: "POST",
                    url: "{{ route('get.event.data') }}",
                    data: {
                        event_id: event_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#event_id').val(response.event_id)
                        $('#event_status').val(response.event_status)
                    }
                });
                // sel.addEventListener("change", () => {
                //     let selectedOption = sel.options[sel.selectedIndex];
                //     // console.log(selectedOption); // get the element
                //     // console.log(selectedOption.value); //get the value attribute
                //     // console.log(selectedOption.innerText); // get the inner text
                //     var evet_status = selectedOption.value
                // });
            });

            // Update Status Event
            $('#submitStatus').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                var formData = new FormData();
                formData.append('event_id', $("#event_id").val());
                formData.append('event_status', $("#event_status").val());

                $.ajax({
                    url: "{{ route('eventUpdate.status') }}",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,

                    success: function(response) {
                        console.log(response)
                        if (response.errors) {
                            $('#update-profile').html('Store Data User');
                            $('.alert').html('');
                            $.each(response.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>' + value +
                                    '</li></strong>');
                            });
                            $('#submitStatus').html('Simpan');
                        } else {
                            $('.alert-danger').hide();
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

                            $('#submitStatus').html('Simpan');
                            $('#updateStatus').modal('hide');
                            table.draw();
                        }
                    }
                });
            });

            // Update Status Category
        });
    </script>
@endpush
