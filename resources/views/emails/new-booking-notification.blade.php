<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Notification</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f7f7f7;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
        }
        .header {
            background-color: #f7f7f7;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: #28a745;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #777;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
        .booking-details {
            background-color: #fdfdfd;
            border: 1px solid #eee;
            padding: 15px;
            border-radius: 4px;
        }
        .booking-details table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        .booking-details th, .booking-details td {
            text-align: left;
            padding: 8px 10px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }
        .booking-details th {
            width: 160px;
            background: #f7f7f7;
        }
        .booking-details ul {
            padding-left: 18px;
            margin: 0;
        }
        .booking-details a {
            color: #007bff;
            text-decoration: underline;
            word-break: break-all;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Booking!</h1>
        </div>
        <div class="content">
            <h2>You have a new booking request.</h2>
            <p>A new booking has been made on your website. Here are the details:</p>

            <div class="booking-details">
                <h3 style="margin-top:0;">Booking Details:</h3>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Service:</th>
                        <td>{{ $booking->service->title }}</td>
                    </tr>
                    <tr>
                        <th>Date:</th>
                        <td>{{ $booking->booking_date->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Time:</th>
                        <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Customer Name:</th>
                        <td>{{ $booking->customer_name }}</td>
                    </tr>
                    <tr>
                        <th>Customer Email:</th>
                        <td>{{ $booking->customer_email }}</td>
                    </tr>
                    <tr>
                        <th>Customer Phone:</th>
                        <td>{{ $booking->customer_phone }}</td>
                    </tr>
                    @if($booking->notes)
                    <tr>
                        <th>Notes:</th>
                        <td>{{ $booking->notes }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Service Media:</th>
                        <td>
                            @if(count($mediaFiles))
                                <ul>
                                    @foreach($mediaFiles as $media)
                                        <li>
                                            <a href="{{ asset('storage/' . $media->file) }}" target="_blank">
                                                View {{ pathinfo($media->file, PATHINFO_EXTENSION) === 'mp4' ? 'Video' : 'Image' }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span>No media files for this service.</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <p>Please review this booking in your admin panel.</p>
        </div>
        <div class="footer">
            <p>This is an automated notification from your website.</p>
        </div>
    </div>
</body>
</html>