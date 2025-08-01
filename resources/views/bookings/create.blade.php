@extends('layouts.app')

@section('content')
@php
    $carouselType = 'book-service';
@endphp

@include('components.dynamic-carousel')

<div class="container py-5">
    <div class="section-title position-relative text-center mb-5">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Book Service</h6>
        <h1 class="font-secondary display-4">Book: {{ $service->title }}</h1>
        <i class="fas fa-calendar-check text-dark"></i>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('services.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            
            <!-- Service Information Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Service Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="font-weight-bold">{{ $service->title }}</h6>
                            <p class="text-muted mb-2">{{ $service->description }}</p>
                            <div class="mt-3">
                                <h6 class="font-weight-bold mb-2">Service Type: {{ $service->service_type ?? 'N/A' }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            @if($service->media->count() > 0)
                                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#serviceMediaModal">
                                    <i class="fas fa-images"></i> View Media ({{ $service->media->count() }})
                                </button>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Service Media Preview -->
                    @if($service->media->count() > 0)
                        <div class="mt-3">
                            <h6 class="font-weight-bold mb-2">Service Media:</h6>
                            <div class="row">
                                @foreach($service->media as $media)
                                    <div class="col-md-3 col-sm-4 col-6 mb-2">
                                        <div class="media-preview-item text-center">
                                            @if($media->is_video)
                                                <div class="media-thumbnail position-relative" style="width: 100%; height: 80px; background: #f8f9fa; border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer;" onclick="playVideo('{{ $media->file_url }}')">
                                                    <i class="fas fa-play-circle text-primary" style="font-size: 24px;"></i>
                                                    <small class="d-block text-muted mt-1">Video</small>
                                                </div>
                                            @else
                                                <div class="media-thumbnail position-relative" style="width: 100%; height: 80px; background: #f8f9fa; border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer;" onclick="showImage('{{ $media->file_url }}')">
                                                    <img src="{{ $media->file_url }}" alt="Service Media" style="max-width: 100%; max-height: 100%; object-fit: cover; border-radius: 8px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <form method="POST" action="{{ route('bookings.store', $service) }}" class="booking-form bg-white p-4 rounded shadow-sm">
                @csrf
                <div class="form-group">
                    <label for="booking_date" class="font-weight-bold">Booking Date:</label>
                    <input type="date" name="booking_date" id="booking_date" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('booking_date') }}" required>

                    @if($errors->has('booking_date'))
                        <small class="text-danger">{{ $errors->first('booking_date') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="booking_time" class="font-weight-bold">Booking Time:</label>
                    <input type="time" name="booking_time" id="booking_time" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('booking_time') }}" required>
                </div>
                <div class="form-group">
                    <label for="customer_name" class="font-weight-bold">Your Name:</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('customer_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="customer_email" class="font-weight-bold">Email:</label>
                    <input type="email" name="customer_email" id="customer_email" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('customer_email') }}" required>
                </div>
                <div class="form-group">
                    <label for="customer_phone" class="font-weight-bold">Phone:</label>
                    <input type="text" name="customer_phone" id="customer_phone" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('customer_phone') }}" required>
                    <small class="form-text text-dark">You can enter multiple numbers separated by commas. e.g., 90260XXXXX, 9984XXXXX</small>
                </div>

                <div class="form-group">
                    <label for="notes" class="font-weight-bold">Notes (optional):</label>
                    <textarea name="notes" id="notes" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Notes (optional)" rows="3">{{ old('notes') }}</textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success font-weight-bold px-5 py-2" data-loading="Processing Request...">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="submit-text">Book Now</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


<!-- Service Media Modal -->
<div class="modal fade" id="serviceMediaModal" tabindex="-1" role="dialog" aria-labelledby="serviceMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceMediaModalLabel">{{ $service->title }} - Media Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($service->media as $media)
                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="media-item text-center">
                                @if($media->is_video)
                                    <div class="video-item" style="cursor: pointer;" onclick="playVideo('{{ $media->file_url }}')">
                                        <div style="width: 100%; height: 150px; background: #f8f9fa; border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 2px solid #e9ecef;">
                                            <i class="fas fa-play-circle text-primary" style="font-size: 48px;"></i>
                                        </div>
                                        <p class="mt-2 mb-0 text-muted">Video {{ $loop->iteration }}</p>
                                    </div>
                                @else
                                    <div class="image-item" style="cursor: pointer;" onclick="showImage('{{ $media->file_url }}')">
                                        <img src="{{ $media->file_url }}" alt="Service Media" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px; border: 2px solid #e9ecef;">
                                        <p class="mt-2 mb-0 text-muted">Image {{ $loop->iteration }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Service Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="img_service" src="" alt="Service Image" style="max-width: 100%; max-height: 70vh; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<!-- Video Modal Start -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>        
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="video_service"  allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->

<!-- Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="thankYouModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="thankYouModalLabel">Thank You!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Thank you for contacting us! We will get back to you soon.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
function playVideo(videoUrl) {
    // Close any open modals first
    $('#serviceMediaModal').modal('hide');
    
    // Set the video source and show the video modal
    $('#videoModal').modal('show');
    $('#video_service').attr('src', videoUrl + "?autoplay=1&modestbranding=1&showinfo=0");
}

function showImage(imageUrl) {
    // Close any open modals first
    $('#serviceMediaModal').modal('hide');
    
    // Set the image source and show the image modal
    $('#img_service').attr('src', imageUrl);
    $('#imageModal').modal('show');
}

// Reset video when modal is closed
$('#videoModal').on('hide.bs.modal', function() {
    $("#video_service").attr('src', '');
});

// Reset image when modal is closed
$('#imageModal').on('hide.bs.modal', function() {
    $("#img_service").attr('src', '');
});
</script>


