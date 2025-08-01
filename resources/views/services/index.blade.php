
@extends('layouts.app')

@section('content')
@php
    $carouselType = 'services';
@endphp

@include('components.dynamic-carousel')

<div class="container py-5">
    <div class="section-title position-relative text-center mb-5">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Our Services</h6>
        <h1 class="font-secondary display-4">Our Services</h1>
        <i class="fas fa-music text-dark"></i>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @auth
        @if(auth()->user()->is_admin)
            <div class="mb-4 text-right">
                <a href="{{ route('services.create') }}" class="btn btn-primary font-weight-bold px-4 py-2">Add New Service</a>
            </div>
        @endif
    @endauth
    
    <form method="GET" action="{{ route('services.index') }}" class="mb-4 d-flex justify-content-end align-items-center">
        <label for="service_type" class="mr-2 mb-0 font-weight-bold">Filter by Type:</label>
        <select name="service_type" id="service_type" class="form-control w-auto bg-secondary border-0 py-2 px-3 mr-2" onchange="this.form.submit()">
            <option value="">All Types</option>
            @foreach($serviceTypes as $key => $label)
                <option value="{{ $key }}" {{ (request('service_type') == $key) ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <noscript><button type="submit" class="btn btn-primary ml-2">Filter</button></noscript>
    </form>

    <div class="row">
        @forelse($services as $service)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 service-card">
                    <div class="card-img-top position-relative" style="height:220px; background:#f8f9fa; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                        @php $firstMedia = $service->media->first(); @endphp
                        @if($firstMedia)
                            @if($firstMedia->is_video)
                                <div style="position:relative; width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
                                    <video src="{{ $firstMedia->file_url }}" style="max-width:100%; max-height:100%; border-radius:8px;" poster="{{ $service->media->where('is_video', false)->first()->file_url ?? '' }}" muted></video>
                                    <button class="btn btn-light btn-play position-absolute" style="top:50%; left:50%; transform:translate(-50%,-50%); border-radius:50%; padding:0.5rem 0.7rem; font-size:2rem;" onclick="playVideo('{{ $firstMedia->file_url }}')"><span></span></button>                                   
                                </div>
                            @else
                                <img src="{{ $firstMedia->file_url }}" alt="Service Image" style="width:100%; height:100%; object-fit:cover; border-radius:8px;">
                            @endif
                        @else
                            <div class="text-muted">No Media</div>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title font-secondary mb-2">{{ $service->title }}</h5>

                        <p class="card-text text-muted mb-2" style="min-height: 48px;">{{ $service->description }}</p>

                        @if($service->media->count() > 1)
                            <div class="card-footer bg-white border-0 pt-2 px-0">
                                <div class="d-flex flex-wrap">
                                    @foreach($service->media->slice(1) as $media)
                                        @if($media->is_video)                                            
                                            <a href="javascript:void(0);" onclick="playVideo('{{ $media->file_url }}')" class="btn btn-sm btn-outline-primary mr-2 mb-2" title="Play Video">
                                                <i class="fa fa-video text-primary mr-1"></i> Video
                                            </a>
                                        @else
                                            <a href="{{ $media->file_url }}" target="_blank" class="btn btn-sm btn-outline-primary mr-2 mb-2" title="View Image">
                                                <i class="fa fa-image text-primary mr-1"></i> Image
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="mt-auto d-flex flex-wrap justify-content-between align-items-center">
                            @auth
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-outline-primary mr-2 mb-1">Edit</a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="mb-1" onsubmit="return confirm('Delete this service?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                @else
                                    <a href="{{ route('bookings.create', $service) }}" class="btn btn-sm btn-success mb-1">Book Now</a>
                                @endif
                            @endauth

                            @guest
                                <a href="{{ route('bookings.create', $service) }}" class="btn btn-sm btn-success mb-1">Book Now</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No services available.</div>
        @endforelse
    </div>
</div>

<!-- Video Modal for Card Grid -->
<div class="modal fade" id="video_img_Modal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="close m-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="video_card" allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    function playVideo(videoUrl) {
        $('#video_img_Modal').modal('show');
        $('#video_card').attr('src', videoUrl + "?autoplay=1&modestbranding=1&showinfo=0");
    }
    $('#video_img_Modal').on('hide.bs.modal', function() {
        $("#video_card").attr('src', '');
    });
</script>
@endsection


