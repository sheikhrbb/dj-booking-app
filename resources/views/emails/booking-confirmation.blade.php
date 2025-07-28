<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background-color: #f7f7f7; padding: 10px 20px; border-bottom: 1px solid #ddd; text-align: center; }
        .header h1 { margin: 0; color: #007bff; }
        .content { padding: 20px; }
        .footer { text-align: center; font-size: 0.9em; color: #777; padding-top: 20px; border-top: 1px solid #ddd; margin-top: 20px; }
        .booking-details { background-color: #fdfdfd; border: 1px solid #eee; padding: 15px; border-radius: 4px; }
        .booking-details th { text-align: left; padding-right: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Mustak & Events</h1>
        </div>
        <div class="content">
            <h2>Booking Confirmation</h2>
            <p>Dear {{ $booking->customer_name }},</p>
            <p>Thank you for booking with us! Your booking is confirmed. We are excited to be a part of your event.</p>
            
            <div class="booking-details">
                <h3>Your Booking Details:</h3>
                <table>
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
                </table>
            </div>

            <p>If you have any questions, feel free to contact us at any time.</p>
            <p>Best regards,<br>The Mustak & Events Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Mustak & Events. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 