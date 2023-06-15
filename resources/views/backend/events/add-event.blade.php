@extends('backend.layouts.main')

@push('style-alt')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/easymde/easymde.min.css') }}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Data Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Events</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add New Event</h6>
                        <p class="text-muted mb-3">Fill the blanks correctly.</p>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;"
                            style="color: red">
                        </div>
                        <form class="forms-sample" id="eventForm">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script-alt')
    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('backend/assets/js/tinymce.js') }}"></script>
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

            // Store Data Event
            $('#submitBtnEvent').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                tinyMCE.triggerSave();

                $.ajax({
                    url: "{{ route('event.store') }}",
                    data: new FormData(this.form),
                    type: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,

                    success: function(response) {
                        console.log(response)
                        if (response.errors) {
                            $('#update-profile').html('Store Data Event');
                            $('.alert').html('');
                            $.each(response.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>' + value +
                                    '</li></strong>');
                            });
                            $('#submitBtnEvent').html('Save');
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

                            $('#userForm').trigger("reset");
                            $('#submitBtnEvent').html('Save');
                            window.location = '{{ route('event.index') }}'

                        }
                    }
                });
            });
        });
    </script>
@endpush
