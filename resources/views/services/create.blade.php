@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="section-title position-relative text-center mb-5">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Service Management</h6>
        <h1 class="font-secondary display-4">Add New Service</h1>
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
            <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data" class="service-form bg-white p-4 rounded shadow-sm">
                @csrf
                <div class="form-group">
                    <label for="service_type" class="font-weight-bold">Service Type:</label>
                    <select name="service_type" id="service_type" class="form-select bg-secondary border-0 py-4 px-3 w-100" required>
                        <option value="">Select Type</option>
                        @foreach($serviceTypes as $key => $label)
                            <option value="{{ $key }}" {{ old('service_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Title:</label>
                    <input type="text" name="title" id="title" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Your Title" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="description" class="font-weight-bold">Description:</label>
                    <textarea name="description" id="description" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Description" rows="4">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="media" class="font-weight-bold">Image/Video (max 5):</label>
                    <input type="file" name="media[]" id="media" class="form-control-file" accept="image/*,video/*" multiple>
                </div>
                <div class="text-center">
                <button type="submit" class="btn btn-primary font-weight-bold px-5 py-2" data-loading="Adding Service...">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <span class="submit-text">Add Service</span>
                </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



