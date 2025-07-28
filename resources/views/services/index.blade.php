
@extends('layouts.app')

@section('content')
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

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image/Video</th>
                    <th style="width: 180px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td class="align-middle font-weight-bold">{{ $service->title }}</td>
                    <td class="align-middle">{{ $service->description }}</td>
                    <td class="align-middle">
                        @foreach($service->media ?? [] as $media)
                            @php
                                $ext = pathinfo($media->file, PATHINFO_EXTENSION);
                                $isVideo = in_array(strtolower($ext), ['mp4','avi','mov','wmv','flv','webm','mkv']);
                            @endphp
                            <div style="display:inline-block; margin:5px; text-align:center;">
                                @if($isVideo)
                                    <!-- <video src="{{ asset('storage/' . $media->file) }}" style="max-width:100px;max-height:100px; display:block;" controls></video> -->
                                    <a href="{{ asset('storage/' . $media->file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1" title="View Video">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @else
                                    <!-- <img src="{{ asset('storage/' . $media->file) }}" class="img-thumbnail" style="max-width:100px;max-height:100px; display:block;"> -->
                                    <a href="{{ asset('storage/' . $media->file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1" title="View Image">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </td>
                    <td class="align-middle text-center">
                        @auth
                            @if(auth()->user()->is_admin)
                                <!-- Admin: Show Edit, Delete -->
                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-outline-primary mr-2">Edit</a>
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this service?')">Delete</button>
                                </form>
                            @else
                                <!-- Logged-in but not admin: Show only Book Now -->
                                <a href="{{ route('bookings.create', $service) }}" class="btn btn-sm btn-success">Book Now</a>
                            @endif
                        @endauth

                        <!-- Show Book Now for guests (not logged in) -->
                        @guest
                            <a href="{{ route('bookings.create', $service) }}" class="btn btn-sm btn-success">Book Now</a>
                        @endguest
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No services available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


