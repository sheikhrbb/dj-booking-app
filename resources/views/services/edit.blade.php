@extends('layouts.app')

@section('content')
@php
    $carouselType = 'edit-service';
@endphp

@include('components.dynamic-carousel')

<div class="container py-5">
    <div class="section-title position-relative text-center mb-5">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Service Management</h6>
        <h1 class="font-secondary display-4">Update Service</h1>
        <i class="fas fa-music text-dark"></i>
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
            <form method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data" class="edit-service-form bg-white p-4 rounded shadow-sm">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="service_type" class="font-weight-bold">Service Type:</label>
                    <select name="service_type" id="service_type" class="form-select bg-secondary border-0 py-4 px-3 w-100" required>
                        <option value="">Select Type</option>
                        @foreach($serviceTypes as $key => $label)
                            <option value="{{ $key }}" {{ (old('service_type', $service->service_type) == $key) ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Title:</label>
                    <input type="text" name="title" id="title" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Your Title" value="{{ old('title', $service->title) }}" required>
                </div>
                <div class="form-group">
                    <label for="description" class="font-weight-bold">Description:</label>
                    <textarea name="description" id="description" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Description" rows="4">{{ old('description', $service->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="media" class="font-weight-bold">Image/Video (max 5):</label><br>
                    @foreach($service->media as $media)
                        <div class="media-preview" style="display:inline-block; margin:5px; text-align:center; position:relative;">
                            <button type="button" class="remove-media-btn" data-media-id="{{ $media->id }}" style="position:absolute;top:0;right:0;background:red;color:white;border:none;border-radius:50%;width:24px;height:24px;z-index:2;">&times;</button>
                            @if($media->is_video)
                                <a href="{{ $media->file_url }}" target="_blank">
                                    <video src="{{ $media->file_url }}" style="max-width:100px;max-height:100px;" controls></video>
                                </a>
                            @else
                                <a href="{{ $media->file_url }}" target="_blank">
                                    <img src="{{ $media->file_url }}" class="img-thumbnail" style="max-width:100px;max-height:100px;">
                                </a>
                            @endif
                        </div>
                    @endforeach
                    <input type="file" name="media[]" id="media" class="form-control-file" accept="image/*,video/*" multiple>
                    <small class="form-text text-muted">Supported formats: Images (jpg, png, gif) and Videos (mp4, avi, mov, wmv, flv, webm, mkv)</small>
                </div>
                <div class="text-center">
                    <!-- <button type="submit" class="btn btn-primary font-weight-bold px-5 py-2">Update Service</button> -->
                    <button type="submit" class="btn btn-primary font-weight-bold px-5 py-2" data-loading="Updating...">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="submit-text">Update Service</span>
                    </button>
                </div>
                <input type="hidden" id="existing-media-count" value="{{ $service->media->count() }}">
                <input type="hidden" name="delete_media_ids" id="delete-media-ids" value="">
            </form>
        </div>
    </div>
</div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        let deleteMediaIds = [];
        document.querySelectorAll('.remove-media-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const mediaId = this.getAttribute('data-media-id');
                deleteMediaIds.push(mediaId);
                document.getElementById('delete-media-ids').value = deleteMediaIds.join(',');
                // Optionally hide the preview
                this.parentElement.style.display = 'none';
            });
        });
    });
</script>