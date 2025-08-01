<!-- Dynamic Carousel Component -->
<div class="container-fluid p-0 mb-5 pb-5" id="home">
    <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            @if(isset($carouselType) && $carouselType === 'services')
                <!-- Services List Page Carousel -->
                <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{ asset('img/bg_dj-1.jpg') }}" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">Our Services</h1>
                            <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">Discover Our Amazing DJ Services</h3>
                            </div>
                            <p class="text-white mb-4">From Floor DJ to Baraat Procession, we offer comprehensive entertainment solutions for your special events.</p>
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
                            <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">Professional DJ Services</h1>
                            <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">Quality Entertainment Guaranteed</h3>
                            </div>
                            <p class="text-white mb-4">Experience the best in music and entertainment with our professional DJ services.</p>
                            <button type="button" class="btn-play mx-auto" data-toggle="modal"
                                data-src="{{ asset('videos/Dj_vdoo.mp4') }}" data-target="#videoModal">
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            @elseif(isset($carouselType) && $carouselType === 'create-service')
                <!-- Create Service Page Carousel -->
                <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{ asset('img/bg_dj-1.jpg') }}" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">Add New Service</h1>
                            <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">Expand Your Service Portfolio</h3>
                            </div>
                            <p class="text-white mb-4">Add new services to your portfolio and reach more customers with our comprehensive service management.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{ asset('img/bg_dj-2.jpg') }}" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">Service Management</h1>
                            <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">Professional Service Creation</h3>
                            </div>
                            <p class="text-white mb-4">Create and manage your services with detailed descriptions and media uploads.</p>
                        </div>
                    </div>
                </div>
            @elseif(isset($carouselType) && $carouselType === 'edit-service')
                <!-- Edit Service Page Carousel -->
                <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{ asset('img/bg_dj-1.jpg') }}" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">Update Service</h1>
                            <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">Modify Service Details</h3>
                            </div>
                            <p class="text-white mb-4">Update your service information, descriptions, and media to keep your offerings current and attractive.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{ asset('img/bg_dj-2.jpg') }}" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">Service Management</h1>
                            <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">Professional Service Updates</h3>
                            </div>
                            <p class="text-white mb-4">Keep your services up-to-date with the latest information and media content.</p>
                        </div>
                    </div>
                </div>
            @elseif(isset($carouselType) && $carouselType === 'book-service')
                <!-- Book Service Page Carousel -->
                <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{ asset('img/bg_dj-1.jpg') }}" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">Book Service</h1>
                            <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">Reserve Your Entertainment</h3>
                            </div>
                            <p class="text-white mb-4">Secure your date and time for professional DJ entertainment services.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{ asset('img/bg_dj-2.jpg') }}" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">Professional Booking</h1>
                            <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">Easy & Secure Booking</h3>
                            </div>
                            <p class="text-white mb-4">Book your preferred service with our simple and secure booking process.</p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Default Home Page Carousel -->
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
            @endif
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
<!-- Carousel End -->

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

