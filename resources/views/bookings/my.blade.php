@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="section-title position-relative text-center mb-5">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">My Bookings</h6>
        <h1 class="font-secondary display-4">All Service Bookings</h1>
        <i class="fas fa-calendar-check text-dark"></i>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($bookings->isEmpty())
    <div class="alert alert-info text-center">You have not booked any services yet.</div>
    @else
    <div class="table-responsive">
        <div id="flash-message"></div>
        <!-- search work -->
        <form method="GET" action="{{ route('bookings.my') }}" class="mb-4" id="searchForm">
            <div class="form-row">
                <div class="form-group col-md-6 position-relative">
                    <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search by Service, Name, Mobile" value="{{ request('search') }}">
                    <span class="clear-input" style="position: absolute; top: 8px; right: 10px; cursor: pointer; font-weight: bold; display: none;" id="clearSearch">&times;</span>
                </div>
                <div class="form-group col-md-4">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                </div>
            </div>
        </form>


         <!-- end -->
        <table class="table table-bordered table-hover bg-white rounded">
            <thead class="thead-dark">
                <tr>
                    <th>Service</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Setup</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->service->title ?? 'N/A' }}</td>
                    <td>{{ $booking->customer_name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</td>
                    <td>
                        <div class="status-display" data-id="{{ $booking->id }}">
                            <span class="badge 
                                    {{ $booking->status === 'pending' ? 'badge-warning' : 
                                    ($booking->status === 'confirmed' ? 'badge-success' : 
                                    ($booking->status === 'cancelled' ? 'badge-danger' : 'badge-secondary')) }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        <div class="status-edit d-none">
                            <select class="form-control form-control-sm status-select" data-id="{{ $booking->id }}">
                                <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </td>


                    <td>{{ $booking->notes }}</td>
                    <td>
                        @php
                            // Parse phone numbers - handle multiple formats
                            $phones = [];
                            if (!empty($booking->customer_phone)) {
                                // Split by common delimiters
                                $phoneArray = preg_split('/[,;\s]+/', trim($booking->customer_phone));
                                foreach ($phoneArray as $phone) {
                                    $phone = trim($phone);
                                    if (!empty($phone)) {
                                        // Clean phone number (remove spaces, dashes, etc.)
                                        $cleanPhone = preg_replace('/[^0-9+]/', '', $phone);
                                        if (!empty($cleanPhone)) {
                                            $phones[] = $cleanPhone;
                                        }
                                    }
                                }
                            }
                        @endphp
                        
                        @if(!empty($phones))
                            @foreach($phones as $phone)
                                <a href="https://wa.me/{{ $phone }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-success mr-1 mb-1" 
                                   title="Send WhatsApp to {{ $phone }}"
                                   style="border-radius: 50%; width: 35px; height: 35px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fab fa-whatsapp" style="font-size: 16px;"></i>
                                </a>
                            @endforeach
                        @else
                            <span class="text-muted">No Phone</span>
                        @endif
                    </td>
                    <td>{{ $booking->customer_email }}</td>
                    <td>
                        @if($booking->service && $booking->service->media && count($booking->service->media))
                        @foreach($booking->service->media as $media)
                        @php
                        $ext = pathinfo($media->file, PATHINFO_EXTENSION);
                        $isVideo = in_array(strtolower($ext), ['mp4','avi','mov','wmv','flv','webm','mkv']);
                        @endphp
                        <div style="display:inline-block; margin:5px; text-align:center;">
                            <a href="{{ asset('storage/' . $media->file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1" title="View {{ $isVideo ? 'Video' : 'Image' }}">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                        @endforeach
                        @else
                        <span class="text-muted">No Media</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endif
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {
        // On double-click, toggle to edit mode
        $('.status-display').on('dblclick', function() {
            let td = $(this).closest('td');
            td.find('.status-display').addClass('d-none');
            td.find('.status-edit').removeClass('d-none');
        });

        // On status change, submit AJAX and update badge
        $('.status-select').on('change', function() {
            let newStatus = $(this).val();
            let bookingId = $(this).data('id');
            let td = $(this).closest('td');

            $.ajax({
                url: `/bookings/${bookingId}/status`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT',
                    status: newStatus
                },
                success: function(response) {
                    let badgeClass = 'badge-secondary';
                    if (newStatus === 'pending') badgeClass = 'badge-warning';
                    else if (newStatus === 'confirmed') badgeClass = 'badge-success';
                    else if (newStatus === 'cancelled') badgeClass = 'badge-danger';

                    td.find('.status-display span')
                        .attr('class', 'badge ' + badgeClass)
                        .text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));

                    td.find('.status-display').removeClass('d-none');
                    td.find('.status-edit').addClass('d-none');
                    $('#flash-message').html('<div class="alert alert-success">' + response.success + '</div>');
                    setTimeout(function() {
                        $('#flash-message').addClass('d-none').text('');
                    }, 5000);

                },
                error: function(xhr, status, error) {
                    alert('Failed to update status.');
                    console.error('AJAX Error:', xhr.responseText);
                }
            });

        });

        // search work
        const searchInput = document.getElementById('searchInput');
        const clearBtn = document.getElementById('clearSearch');

        function toggleClearBtn() {
            clearBtn.style.display = searchInput.value.length ? 'block' : 'none';
        }

        searchInput.addEventListener('input', toggleClearBtn);
        
        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            toggleClearBtn();
            document.getElementById('searchForm').submit(); // optional: auto-submit on clear
        });

        // Initial check
        toggleClearBtn();
        
    });
</script>