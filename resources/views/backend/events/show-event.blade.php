@extends('backend.layouts.main')

@push('style-alt')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/dropzone/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/dropify/dist/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/pickr/themes/classic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/easymde/easymde.min.css') }}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Data Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Events</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Event Details</h6>
                        <p class="text-muted mb-3">All about selected event data.</p>
                        <div class="text-center mb-3">
                            <h4>Event Poster</h4>
                        </div>
                        <div class="col-md-12 image-responsive align-items-center text-center mb-4">
                            <img id="preview_poster" class="img-fluid"
                                src="{{ asset('storage/event_poster/' . $event->event_poster) }}" alt="">
                        </div>
                        <div class="text-center mb-3"></div>
                        <div class="table-responsive">
                            <table class="table-striped">
                                <tr>
                                    <th colspan="4">
                                        <div class="bagde bg-success text-white text-center">Event Data</div>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">Name Event</th>
                                    <th>:</th>
                                    <td>{{ ucfirst($event->event_name) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Date Held</th>
                                    <th>:</th>
                                    <td>{{ date('d F Y', strtotime($event->date_held)) }} |
                                        {{ date('h:i:sa', strtotime($event->date_held)) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Event Description</th>
                                    <th>:</th>
                                    <td>{{ strip_tags($event->event_description) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Location Held</th>
                                    <th>:</th>
                                    <td>{{ ucfirst($event->location_held) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Event Status</th>
                                    <th>:</th>
                                    <td>
                                        @if ($event->event_status == 'listing')
                                            <div class="badge bg-secondary">{{ ucfirst($event->event_status) }}</div>
                                        @elseif ($event->event_status == 'archive')
                                            <div class="badge bg-danger">{{ ucfirst($event->event_status) }}</div>
                                        @elseif ($event->event_status == 'publish')
                                            <div class="badge bg-info">{{ ucfirst($event->event_status) }}</div>
                                        @else
                                            <div class="badge bg-success">{{ ucfirst($event->event_status) }}</div>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <table class="table table-striped" id="ticket_category">
                            @php($no = 1)
                            <tr>
                                <th colspan="3">Category Ticket No.</th>
                                <th>Category Name</th>
                                <th>Category Price</th>
                                <th>Category Quota</th>
                                <th>Category Status</th>
                            </tr>
                            @foreach ($event->ticketCategory as $item)
                                <tr>
                                    <td colspan="3">Ticket Category {{ $no++ }}</td>
                                    <td>
                                        <div class="badge bg-success">{{ ucfirst($item->ticket_category_name) }}</div>
                                    </td>
                                    <td>Rp. {{ number_format($item->ticket_category_price) }}</td>
                                    <td>{{ $item->ticket_category_quota }} tickets</td>
                                    <td>
                                        <div
                                            class="badge bg-{{ $item->ticket_category_status == 'sold out' ? 'danger' : ($item->ticket_category_status == 'soon' ? 'warning' : 'success') }}">
                                            {{ ucfirst($item->ticket_category_status) }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <hr>
                        <table class="table table-striped">
                            @php($no = 1)
                            <tr>
                                <th>Event Talent No</th>
                                <th>Event Talent Name</th>
                                <th>Event Talent Photo</th>
                            </tr>
                            @foreach ($event->eventTalent as $item)
                                <tr>
                                    <td>Event Talent {{ $no++ }}</td>
                                    <td>
                                        <div class="badge bg-success">{{ ucfirst($item->event_talent_name) }}</div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 image-responsive align-items-center text-center mb-2">
                                        </div>
                                        <img id="preview_poster" class="img-fluid" src="#" alt="" download>
                                        {{-- <img id="preview_poster" class="img-fluid"
                                            src="{{ asset('storage/event_talent/' . $item->event_talent_img) }}"
                                            alt="" download> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{-- <form class="forms-sample" id="eventForm">
                            <div class="row mb-4">
                                <input type="hidden" name="event_id" id="event_id">
                                <div class="col">
                                    <label class="form-label">Name Event:</label>
                                    <input class="form-control mb-4 mb-md-0" type="text" id="event_name"
                                        name="event_name" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date Held:</label>
                                    <input class="form-control" type="datetime-local" id="date_held" name="date_held" />
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                                <div class="col">
                                    <label class="form-label">Event Poster:</label>
                                    <input class="form-control" type="file" id="event_poster" name="event_poster" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 image-responsive align-items-center text-center">
                                    <img id="preview_poster" class="img-fluid" src="" alt="">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Event Description:</label>
                                    <textarea class="form-control tinymceExample" name="event_description" id="event_description" rows="10"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Location on Held:</label>
                                    <textarea class="form-control" name="location_held" id="location_held" rows="5"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-2">
                                <h4 class="mb-3">Ticket Category</h4>
                                <hr>
                                <div class="ticket_wrapper">
                                    <div class="row">
                                        <input type="hidden" name="ticket_category_id[]" id="ticket_category_id">
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon2">Category Name</span>
                                                <input type="text" id="ticket_category_name" class="form-control"
                                                    name="ticket_category_name[]" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon2">Ticket Pricing</span>
                                                <input type="number" id="ticket_category_price" class="form-control"
                                                    name="ticket_category_price[]" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon2">Ticket Quota</span>
                                                <input type="number" id="ticket_category_quota" class="form-control"
                                                    name="ticket_category_quota[]" />
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" id="addBtnTicket" class="btn btn-primary"><i
                                                    class="mdi mdi-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-2">
                                <h4 class="mb-3">Event Talents</h4>
                                <hr>
                                <div class="talent_wrapper">
                                    <div class="row">
                                        <input type="hidden" name="event_talent_id[]" id="event_talent_id">
                                        <div class="col-md-7">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon2">Talent Name</span>
                                                <input type="text" id="event_talent_name" class="form-control"
                                                    name="event_talent_name[]" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon2"></span>
                                                <input type="file" id="event_talent_img" class="form-control"
                                                    name="event_talent_img[]" />
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" id="addBtnTalent" class="btn btn-primary"><i
                                                    class="mdi mdi-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3 text-center align-items-center">
                                <div class="col-md-12">
                                    <button class="btn btn-primary w-25" id="submitBtnEvent">Save</button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script-alt')
    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/pickr/pickr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/easymde/easymde.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/ace-builds/src-min/ace.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/ace-builds/src-min/theme-chaos.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('backend/assets/js/tinymce.js') }}"></script>
    <script src="{{ asset('backend/assets/js/easymde.js') }}"></script>
    <script src="{{ asset('backend/assets/js/ace.js') }}"></script>
    <!-- End custom js for this page -->

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#event_poster').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview_poster').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            })

            // max field dinamis input
            var maxField = 15; //Input fields increment limitation

            // Append Ticket Category Input
            var addButtonTicket = $('#addBtnTicket'); //Add button selector
            var wrapperTicket = $('.ticket_wrapper'); //Input field wrapper
            var fieldHTMLTicket =
                `<div class="row">
                    <input type="hidden" name="ticket_category_id[]" id="ticket_category_id">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Category Name</span>
                            <input type="text" id="ticket_category_name" class="form-control"
                                name="ticket_category_name[]" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Ticket Pricing</span>
                            <input type="number" id="ticket_category_price" class="form-control"
                                name="ticket_category_price[]"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Ticket Quota</span>
                            <input type="number" id="ticket_category_quota" class="form-control"
                                name="ticket_category_quota[]"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                            <a href="javascript:void(0);" class="minusTicket btn btn-danger"><i
                                class="mdi mdi-minus"></i></a>
                    </div>
                </div>`;
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButtonTicket).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapperTicket).append(fieldHTMLTicket); //Add field html
                    if (x == 15) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ticket category has reached the limit',
                        })
                    }
                }
            });

            //Once remove button is clicked
            $(wrapperTicket).on('click', '.minusTicket', function(e) {
                e.preventDefault();
                $(this).parent('').parent('').remove(); //Remove field html
                x--; //Decrement field counter

                if (x == 1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ticket category at least 1!',
                    })
                }
            });

            // Append Talent Input
            var addButtonTalent = $('#addBtnTalent'); //Add button selector
            var wrapperTalent = $('.talent_wrapper'); //Input field wrapper
            var fieldHTMLTalent =
                `<div class="row">
                    <input type="hidden" name="event_talent_id[]" id="event_talent_id">
                    <div class="col-md-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Talent Name</span>
                            <input type="text" id="event_talent_name" class="form-control"
                                name="event_talent_name[]" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2"></span>
                            <input type="file" id="event_talent_img" class="form-control"
                                name="event_talent_img[]" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:void(0);" class="minusTalent btn btn-danger"><i
                            class="mdi mdi-minus"></i></a>
                    </div>
                </div>`;
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButtonTalent).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapperTalent).append(fieldHTMLTalent); //Add field html
                    if (x == 15) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Talent event has reached the limit',
                        })
                    }
                }
            });

            //Once remove button is clicked
            $(wrapperTalent).on('click', '.minusTalent', function(e) {
                e.preventDefault();
                $(this).parent('').parent('').remove(); //Remove field html
                x--; //Decrement field counter

                if (x == 1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Talent Event at least 1!',
                    })
                }
            });

        });
    </script>
@endpush
