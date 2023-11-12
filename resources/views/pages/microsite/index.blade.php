<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Aqris T. Satria">
    <title>Invoice Manager</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @include('scripts.style')

    <style>
        body {
            background-image: url("/assets/jpg/bg-shell-astra.jpg");
            background-size: cover;
            background-position: center;
        }

        /* For mobile screens */
        @media (max-width: 767px) {
            body {
                background-image: url("/assets/jpg/bg-shell-astra.jpg");
                background-size: cover;
                background-position: center;
            }
        }

        .spacer-222 {
            height: 222px;
        }

        .custom-select {
            height: 50px;
            border-radius: 8px;
        }

        .custom-btn {
            width: 260px;
            height: 50px;
            border-radius: 6px;
            background: #FFC509;
        }

        #scrollDownBtn {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: none;
            height: 88px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-5">
                <div class="text-center">
                    <img src="{{ url('assets/png/sponsor_v2.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="spacer-222"></div>

        <div class="row justify-content-center">
            {{-- Only Show on desktop (hide on mobile) --}}
            <div class="col-9 d-none d-md-block mb-5">
                <div class="text-center">
                    <img src="{{ url('assets/svg/banner.svg') }}" alt="" class="img-fluid m-5">
                </div>
            </div>

            {{-- Only show on mobile (hide on desktop) --}}
            <div class="col-9 d-block d-md-none mb-5">
                <div class="text-center">
                    <img src="{{ url('assets/png/banner.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>


        <div class="row justify-content-center">

            <div class="col-12 mb-3">
                <div class="text-center">
                    <div class="text-white-40">
                        KONFIRMASI <br class="d-md-none"> E-TICKET
                    </div>
                </div>
            </div>

            <div class="col-12 mb-5">
                <div class="text-center">
                    <div class="text-white-20-book">
                        Silakan konfirmasi kehadiran Anda
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mt-3 mb-3">
                    {{-- notification --}}
                    @include('layouts/flash-message-5')
                    {{-- end notification --}}

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-10 col-md-4 mb-5">
                <div class="text-center">
                    <div class="form-group mb-3">
                        <select class="form-select text-black-16 custom-select" aria-label="kehadiran" id="kehadiran">
                            <option value="1">TIDAK HADIR</option>
                            <option value="2" selected>HADIR</option>
                        </select>
                    </div>

                    <form action="{{ route('confirmation') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- Show name, email, and phone also add required if select option hadir --}}
                        <div class="form-group mb-3" id="nameField">
                            <input name="fullname" type="text" class="form-control text-black-16 custom-select"
                                placeholder="Name">
                        </div>

                        <div class="form-group mb-3" id="emailField">
                            <input name="email" type="email" class="form-control text-black-16 custom-select"
                                placeholder="Email">
                        </div>

                        <div class="form-group" id="phoneField">
                            <input name="phone" type="phone" class="form-control text-black-16 custom-select"
                                placeholder="Phone">
                        </div>

                        <div class="form-group mt-5">
                            {{-- Hide button on tidak hadir --}}
                            <button type="submit" class="btn btn-warning text-black-16 custom-btn mb-3"
                                id="submitButton">SUBMIT</button>

                        </div>

                    </form>

                    <div class="form-group">
                        {{-- Show link on hadir --}}
                        <button class="btn btn-warning text-black-16 custom-btn mb-3" id="submitLink" href="#"
                            role="button" data-bs-toggle="modal" data-bs-target="#responseModal"
                            style="display: none;">SUBMIT</button>

                        <div class="modal fade" id="responseModal" tabindex="-1" role="dialog"
                            aria-labelledby="responseModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Thank you for your response!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="row justify-content-center">
            <div class="col-12 mb-3">
                <div class="text-center">
                    <div class="text-white-30">
                        INFORMASI
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <ul class="text-white-paragraph">
                    <li>
                        e-Tiket akan dikirimkan ke email yang terdaftar
                    </li>
                    <li>
                        KTP Asli/Copy dan e-Tiket pemenang terdaftar wajib dibawa dan wajib diperlihatkan saat penukaran
                        e-Tiket di venue acara
                    </li>
                    <li>
                        Penukaran e-Tiket dengan gelang dibuka pada <span class="text-white-paragraph-bold">Selasa, 12
                            Desember 2023 mulai pukul 15:00 WIB</span>
                    </li>
                    <li>
                        1 e-Tiket berlaku untuk 2 orang (tidak dapat ditukarkan terpisah)
                    </li>
                    <li>
                        e-Tiket bisa dipindah tangankan dengan memperlihatkan surat kuasa dan KTP Asli/Copy pemenang
                        terdaftar (tidak berlaku foto)
                    </li>
                    <li>
                        Anak dibawah umur 17 tahun wajib didampingi orang dewasa
                    </li>
                </ul>
            </div>
        </div>

        <div class="spacer-222"></div>

        <div class="modal fade" id="refreshModal" tabindex="-1" role="dialog" aria-labelledby="refreshModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="refreshModalLabel">Notification</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Do you want to continue?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="location.reload();">Yes</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Scroll down button -->
    {{-- <button id="scrollDownBtn" class="btn btn-primary">Scroll Down</button> --}}
    <img src="{{ url('assets/png/scroll_down.png') }}" alt="" class="img-fluid" id="scrollDownBtn">


    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#kehadiran").change(function() {
                var selectedOption = $(this).val();
                var submitButton = $("#submitButton");
                var submitLink = $("#submitLink");

                if (selectedOption == 2) {
                    $("#nameField, #emailField, #phoneField").show();
                    submitButton.show();
                    submitLink.hide();
                    $("#nameField input, #emailField input, #phoneField input").prop("required", true);
                } else {
                    $("#nameField, #emailField, #phoneField").hide();
                    submitButton.hide();
                    submitLink.show();
                    $("#nameField input, #emailField input, #phoneField input").prop("required", false);
                }
            });
        });
    </script>

    <script>
        // Set the time to wait in milliseconds (45 seconds)
        const waitTime = 45000;

        // Function to show the refresh modal
        function showRefreshModal() {
            $('#refreshModal').modal('show');
        }

        // Wait for the specified time and then show the modal
        setTimeout(showRefreshModal, waitTime);
    </script>

    <script>
        $(document).ready(function() {
            var buttonClicked = false;

            // Show scroll down button initially
            $('#scrollDownBtn').fadeIn();

            // Show/hide scroll down button based on scroll position
            $(window).scroll(function() {
                if (!buttonClicked && $(this).scrollTop() + $(this).height() < $(document).height() - 10) {
                    $('#scrollDownBtn').fadeIn();
                } else {
                    $('#scrollDownBtn').fadeOut();
                }
            });

            // Scroll down 30% of page height when button is clicked
            $('#scrollDownBtn').click(function() {
                if (!buttonClicked) {
                    var targetScroll = $(document).height() * 0.3; // Scroll to 30% of page height
                    $('html, body').animate({
                        scrollTop: targetScroll
                    }, 'slow');

                    // Hide the button after the first click
                    $(this).fadeOut();

                    buttonClicked = true;
                }

                return false;
            });
        });
    </script>


</body>

</html>
