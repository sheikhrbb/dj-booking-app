<head>
    <meta charset="utf-8">
    <title>Mustak & Events</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <!-- <link href="{{ asset('img/favicon.png') }}" rel="icon"> -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">


    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"> -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
    <!-- Navbar Start -->
    <nav class="navbar fixed-top shadow-sm navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
        <a href="{{ route('dashboard') }}" class="navbar-brand d-block d-lg-none">
            <h1 class="font-secondary text-white mb-n2">Mustak <span class="text-primary">&</span> Events</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto py-0">
                <a href="#home" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="{{ route('services.index') }}" class="nav-item nav-link">Services</a>

                <a href="#gallery" class="nav-item nav-link">Gallery</a>
            </div>
            <a href="{{ route('dashboard') }}" class="navbar-brand mx-5 d-none d-lg-block">
                <h1 class="font-secondary text-white mb-n2">Mustak <span class="text-primary">&</span> Events</h1>
            </a>
            <div class="navbar-nav mr-auto py-0">
                @auth
                    @if(auth()->user()->is_admin)
                     <a href="{{ route('bookings.my') }}" class="nav-item nav-link">Bookings</a>
                    @endif
                @endauth
                <a href="{{ route('chatbot.index') }}" class="nav-item nav-link d-none"><i class="fas fa-robot me-1"></i>AI Assistant</a>
                <a href="#event" class="nav-item nav-link">Event</a>
                <a href="#rsvp" class="nav-item nav-link">RSVP</a>
                <a href="#contact" class="nav-item nav-link">Contact</a>
                @auth
                    @if(auth()->user()->is_admin)
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" class="nav-item nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    @endif
                @endauth

                @guest
                    {{-- Only show Login if you want guests to be able to log in as admin --}}
                    <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                @endguest
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    @if(!isset($carouselType))
        <!-- Home Page Carousel Start -->
        <div class="container-fluid p-0 mb-5 pb-5" id="home">
            <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('img/bg_dj-1.jpg') }}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">Mustak & Events</h1>
                                <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                    <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">Feel the heart beats</h3>
                                </div>
                                <button type="button" class="btn-play mx-auto" data-toggle="modal"
                                    data-src="{{ asset('videos/Dj_vdoo.mp4') }}" data-target="#videoModal">
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 100vh; min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('img/bg_dj-2.jpg') }}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">Mustak & Events</h1>
                                <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                    <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">Feel the heart beats</h3>
                                </div>
                                <button type="button" class="btn-play mx-auto" data-toggle="modal"
                                    data-src="{{ asset('videos/Dj_vdoo.mp4') }}" data-target="#videoModal">
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev justify-content-start" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-primary px-0" style="width: 68px; height: 68px;">
                        <span class="carousel-control-prev-icon mt-3"></span>
                    </div>
                </a>
                <a class="carousel-control-next justify-content-end" href="#header-carousel" data-slide="next">
                    <div class="btn btn-primary px-0" style="width: 68px; height: 68px;">
                        <span class="carousel-control-next-icon mt-3"></span>
                    </div>
                </a>
            </div>
        </div>
        <!-- Home Page Carousel End -->

        <!-- Video Modal Start -->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>        
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Modal End -->
    @endif

    