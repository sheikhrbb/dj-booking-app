<!DOCTYPE html>
<html lang="en">


<body data-spy="scroll" data-target=".navbar" data-offset="51">

    @include('pages.include.header')


    <!-- About Start -->
    @php
    $aboutContent = optional(\App\Models\AboutSection::where('section', 'about')->first())->content;
    @endphp

    @if($aboutContent)
    {!! str_replace('{BASE_URL}', asset(''), $aboutContent) !!}
    @else
    <div class="container-fluid py-5" id="about">
        <div class="container py-5">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">About Us</h6>
                <h1 class="font-secondary display-4">More Than Just a DJ Service</h1>
                <i class="fas fa-music text-dark"></i>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <p class="lead text-muted mb-5">
                        Welcome to Mustak & Events, where we turn your celebrations into legendary experiences. We started with a passion for music, but our mission grew. Today, we offer not just electrifying DJ sets, but also high-energy <strong>Punjabi Bhangra performances</strong> and spectacular, <strong>eco-friendly Modern Padaka</strong> (no-pollution fireworks). We bring the sound, the sights, and the energy to make every moment unforgettable.
                    </p>
                </div>
            </div>

            <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0">
                <div class="col-md-6 p-0 text-center text-md-right">
                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                        <h3 class="mb-3">The Beat Master: DJ Mustak</h3>
                        <p>With 100+ live events under his belt, Mustak is the heart of the party. He’s an expert at reading the crowd and curating a vibe that keeps everyone dancing all night long.</p>
                        <h3 class="font-secondary font-weight-normal text-muted mb-3">
                            <i class="fas fa-headphones text-primary pr-3"></i>D.J Mustak
                        </h3>
                        <div class="position-relative">
                            <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-soundcloud"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0" style="min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{ asset('img/about-dj.jpg') }}" style="object-fit: cover;">
                </div>
            </div>

            <div class="row m-0">
                <div class="col-md-6 p-0" style="min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{ asset('img/about-setup.jpg') }}" style="object-fit: cover;">
                </div>
                <div class="col-md-6 p-0 text-center text-md-left">
                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                        <h3 class="mb-3">The Atmosphere Architect: DJ Akhlaaq</h3>
                        <p>Akhlaaq is our master of ambiance. From breathtaking lighting design to crystal-clear sound, he ensures your event looks and feels as good as it sounds.</p>
                        <h3 class="font-secondary font-weight-normal text-muted mb-3">
                            <i class="fas fa-lightbulb text-primary pr-3"></i>D.J Akhlaaq
                        </h3>
                        <div class="position-relative">
                            <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- About End -->





    <!-- Gallery Start -->
    <div class="container-fluid bg-gallery" id="gallery" style="padding: 120px 0; margin: 90px 0;">
        <div class="section-title position-relative text-center" style="margin-bottom: 120px;">
            <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Gallery</h6>
            <h1 class="font-secondary display-4 text-white">Our Photo Gallery</h1>
            <i class="far fa-heart text-white"></i>
        </div>
        <div class="owl-carousel gallery-carousel">
            <div class="gallery-item">
                <img class="img-fluid w-100" src="{{ asset('img/gallery-1.jpg') }}" alt="">
                <a href="{{ asset('img/gallery-1.jpg') }}" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
            <div class="gallery-item">
                <img class="img-fluid w-100" src="{{ asset('img/gallery-2.jpeg') }}" alt="">
                <a href="{{ asset('img/gallery-2.jpeg') }}" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
            <div class="gallery-item">
                <img class="img-fluid w-100" src="{{ asset('img/gallery-6.jpeg') }}" alt="">
                <a href="{{ asset('img/gallery-6.jpeg') }}" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
            <div class="gallery-item">
                <img class="img-fluid w-100" src="{{ asset('img/gallery-4.jpeg') }}" alt="">
                <a href="{{ asset('img/gallery-4.jpeg') }}" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
            <div class="gallery-item">
                <img class="img-fluid w-100" src="{{ asset('img/gallery-5.jpeg') }}" alt="">
                <a href="{{ asset('img/gallery-5.jpeg') }}" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
            <div class="gallery-item">
                <img class="img-fluid w-100" src="{{ asset('img/gallery-3.jpeg') }}" alt="">
                <a href="{{ asset('img/gallery-3.jpeg') }}" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Gallery End -->


    <!-- Event Start -->
    <!-- {!! str_replace('{BASE_URL}', asset(''), optional(\App\Models\AboutSection::where('section', 'event')->first())->content) !!} -->

    <div class="container-fluid py-5" id="event">
        <div class="container py-5">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Events</h6>
                <h1 class="font-secondary display-4">Make Your Event Unforgettable</h1>
                <i class="far fa-calendar-alt text-dark"></i>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-md-8 text-center">
                    <p class="lead text-muted">{!! optional(\App\Models\AboutSection::where('section', 'event')->first())->content !!}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="event-item card h-100 shadow-sm border-0 text-center p-4 hover-shadow">
                        <div class="mb-3">
                            <i class="fas fa-heart fa-2x text-primary"></i>
                        </div>
                        <img class="img-fluid mb-3 rounded" src="img/event-onee.jpg" alt="Wedding DJ">
                        <h4 class="mb-2">Weddings</h4>
                        <p class="text-muted">Creating the perfect soundtrack for your special day, from ceremony to last dance.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="event-item card h-100 shadow-sm border-0 text-center p-4 hover-shadow">
                        <div class="mb-3">
                            <i class="fas fa-briefcase fa-2x text-primary"></i>
                        </div>
                        <img class="img-fluid mb-3 rounded" src="img/event-two.jpg" alt="Corporate Event DJ">
                        <h4 class="mb-2">Corporate Events</h4>
                        <p class="text-muted">Professional DJ services for conferences, galas, team-building, and more.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="event-item card h-100 shadow-sm border-0 text-center p-4 hover-shadow">
                        <div class="mb-3">
                            <i class="fas fa-glass-cheers fa-2x text-primary"></i>
                        </div>
                        <img class="img-fluid mb-3 rounded" src="img/event-3.avif" alt="Private Party DJ">
                        <h4 class="mb-2">Private Parties</h4>
                        <p class="text-muted">Birthdays, anniversaries, or any celebration—let’s make it a party to remember!</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-auto">
                    <a href="{{ route('services.index') }}" class="btn btn-primary btn-lg py-3 px-5">View Services & Book Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Event End -->


    <!-- Friends & Family Start -->
    <div class="container-fluid py-5" id="family">
        <div class="container pt-5 pb-3">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Our DJ Family</h6>
                <h1 class="font-secondary display-4">Happy Clients & Memories</h1>
                <i class="fas fa-users text-dark"></i>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-md-9 text-center">
                    <p class="lead text-muted">Every event is a new story. Here are some of the wonderful people and moments that have made DJ Mustak’s journey so special. Thank you for letting me be part of your celebrations!</p>
                </div>
            </div>
            <div class="row portfolio-container">
                <div class="col-lg-4 col-md-6 mb-4 portfolio-item first">
                    <div class="position-relative mb-2">
                        <img class="img-fluid w-100" src="{{ asset('img/groomsmen-1.jpg') }}" alt="">
                        <div class="bg-secondary text-center p-4">
                            <h4 class="mb-3">Amit & Priya</h4>
                            <p class="text-uppercase">Wedding Celebration</p>
                            <p class="mb-2">“DJ Mustak made our wedding night unforgettable! The dance floor was packed all evening.”</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 portfolio-item second">
                    <div class="position-relative mb-2">
                        <img class="img-fluid w-100" src="img/bridesmaid-1.jpg" alt="">
                        <div class="bg-secondary text-center p-4">
                            <h4 class="mb-3">Corporate Bash</h4>
                            <p class="text-uppercase">Annual Company Party</p>
                            <p class="mb-2">“Professional, energetic, and fun! Our team is still talking about the music.”</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 portfolio-item first">
                    <div class="position-relative mb-2">
                        <img class="img-fluid w-100" src="img/groomsmen-2.jpg" alt="">
                        <div class="bg-secondary text-center p-4">
                            <h4 class="mb-3">Rohit’s Birthday</h4>
                            <p class="text-uppercase">Birthday Bash</p>
                            <p class="mb-2">“The playlist was perfect for all ages. Thank you for making my birthday so much fun!”</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 portfolio-item second">
                    <div class="position-relative mb-2">
                        <img class="img-fluid w-100" src="img/bridesmaid-2.jpg" alt="">
                        <div class="bg-secondary text-center p-4">
                            <h4 class="mb-3">Family Reunion</h4>
                            <p class="text-uppercase">Private Event</p>
                            <p class="mb-2">“Music brought everyone together. DJ Mustak, you’re part of our family now!”</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 portfolio-item first">
                    <div class="position-relative mb-2">
                        <img class="img-fluid w-100" src="img/groomsmen-3.jpg" alt="">
                        <div class="bg-secondary text-center p-4">
                            <h4 class="mb-3">Sana & Friends</h4>
                            <p class="text-uppercase">College Farewell</p>
                            <p class="mb-2">“Best DJ ever! You made our last night together truly memorable.”</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 portfolio-item second">
                    <div class="position-relative mb-2">
                        <img class="img-fluid w-100" src="img/bridesmaid-3.jpg" alt="">
                        <div class="bg-secondary text-center p-4">
                            <h4 class="mb-3">Anniversary Party</h4>
                            <p class="text-uppercase">25th Anniversary</p>
                            <p class="mb-2">“You played all our favorite songs. Thank you for making our milestone so special!”</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Friends & Family End -->


    <!-- RSVP Start -->
    <div class="container-fluid py-5" id="rsvp">
        <div class="container py-5">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">RSVP</h6>
                <h1 class="font-secondary display-4">Join Our Party</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Your Name" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="email" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Your Email" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <select class="form-control bg-secondary border-0" style="height: 52px;">
                                        <option>Number of Guest</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <select class="form-control bg-secondary border-0" style="height: 52px;">
                                        <option>I'm Attending</option>
                                        <option>All Events</option>
                                        <option>Wedding Party</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control bg-secondary border-0 py-2 px-3" rows="5" placeholder="Message" required="required"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary font-weight-bold py-3 px-5" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- RSVP End -->


    @include('pages.include.footer')

    @include('components.chatbot-widget')

</body>

</html>