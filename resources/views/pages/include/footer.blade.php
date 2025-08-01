    
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5" id="contact" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="section-title position-relative text-center">
                <h1 class="font-secondary display-6 text-white">Let’s Make Your Next Event Unforgettable!</h1>
                <i class="fas fa-music text-white"></i>
            </div>
            <p class="lead mb-4">Professional DJ, Punjabi Bhangra Performances, and Eco-Friendly Modern Padaka (No-Pollution Fireworks) for all occasions.</p>
            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-lg btn-outline-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="d-flex justify-content-center py-2">
                <p class="text-white mb-0" href="mailto:info@mustak-events.com">info@mustak-events.com</p>
                <span class="px-3">|</span>
                <p class="text-white mb-0" href="tel:+91 90269 14296">+91 90269 14296</p>
            </div>
            <p class="m-0">&copy; <a class="text-primary" href="#">Mustak & Events</a>. All rights reserved.</p>
        </div>
    </div>
    <!-- Footer End -->

    <i class="fa fa-2x fa-angle-down text-white scroll-to-bottom"></i>

    <a href="#" class="btn btn-lg btn-outline-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(function() {

            function showToast(message) {
                var $toast = $('#file-size-toast');
                $toast.text(message).fadeIn();
                setTimeout(function() {
                    $toast.fadeOut();
                }, 4000);
            }

            // For both create and edit forms
            $('#media').on('change', function() {
                var files = this.files;
                var maxSize = 100 * 1024 * 1024; // 100 MB in bytes
                var maxFiles = 5;

                // Get existing media count (for edit form)
                var existingCount = parseInt($('#existing-media-count').val() || "0", 10);

                // Check for file count (create: just files.length, edit: existing + new)
                if ((existingCount + files.length) > maxFiles) {
                    showToast('You can upload up to 5 files only.');
                    this.value = ""; // Clear the input
                    return;
                }

                // Check for file size
                for (var i = 0; i < files.length; i++) {
                    if (files[i].size > maxSize) {
                        showToast('File "' + files[i].name + '" exceeds 100 MB limit.');
                        this.value = ""; // Clear the input
                        break;
                    }
                }
            });

            @if(session('booking_success'))
                $(function() {
                    $('#thankYouModal').modal('show');
                    setTimeout(function() {
                        window.location.href = "{{ route('dashboard') }}";
                    }, 10000);
                });
            @endif

            function setupValidatedForm(formSelector, rules = {}, messages = {}) {
                $(formSelector).each(function() {
                    $(this).validate({
                        rules: rules,
                        messages: messages,
                        errorClass: "text-danger",
                        errorElement: "div",
                        highlight: function(element) {
                            $(element).addClass("is-invalid");
                        },
                        unhighlight: function(element) {
                            $(element).removeClass("is-invalid");
                        },
                        submitHandler: function(form) {
                            const $btn = $(form).find('button[type="submit"]');
                            $btn.attr('disabled', true);
                            const loadingText = $btn.data('loading') || 'Submitting...';
                            $btn.find('.submit-text').text(loadingText);
                            $btn.find('.spinner-border').removeClass('d-none');
                            form.submit();
                        }
                    });
                });
            }

            // Call for all your forms
            $(document).ready(function () {
                setupValidatedForm('.booking-form', {
                    booking_date: { required: true, date: true },
                    booking_time: { required: true },
                    customer_name: { required: true, minlength: 2 },
                    customer_email: { required: true, email: true },
                    customer_phone: { required: true, minlength: 10 }
                }, {
                    booking_date: {
                        required: "Please select a booking date",
                        date: "Please enter a valid date"
                    },
                    booking_time: {
                        required: "Please select a booking time"
                    },
                    customer_name: {
                        required: "Please enter your name",
                        minlength: "Name must be at least 2 characters"
                    },
                    customer_email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    customer_phone: {
                        required: "Please enter your phone number",
                        minlength: "Phone number must be at least 10 digits"
                    }
                });
                setupValidatedForm('.service-form', {
                    title: { required: true, minlength: 2 },
                    description: { required: true, minlength: 5 }
                }, {
                    title: {
                        required: "Please enter a title",
                        minlength: "Title must be at least 2 characters"
                    },
                    description: {
                        required: "Please enter a description",
                        minlength: "Description must be at least 5 characters"
                    }
                });
                setupValidatedForm('.edit-service-form', {
                    title: { required: true, minlength: 2 },
                    description: { required: true, minlength: 5 }
                }, {
                    title: {
                        required: "Please enter a title",
                        minlength: "Title must be at least 2 characters"
                    },
                    description: {
                        required: "Please enter a description",
                        minlength: "Description must be at least 5 characters"
                    }
                });
                setupValidatedForm('.forgot-password-form', {
                    email: { required: true, email: true }
                }, {
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    }
                });
                setupValidatedForm('.reset-password-form', {
                    password: { required: true, minlength: 6 },
                    password_confirmation: { required: true, equalTo: "#password" }
                }, {
                    password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least 6 characters"
                    },
                    password_confirmation: {
                        required: "Please enter your password again",
                        equalTo: "Passwords do not match"
                    }
                });
                setupValidatedForm('.login-form', {
                    email: { required: true, email: true },
                    password: { required: true }
                }, {
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password"
                    }
                });
                setupValidatedForm('.editor-form');
            });
        });
    </script>
  