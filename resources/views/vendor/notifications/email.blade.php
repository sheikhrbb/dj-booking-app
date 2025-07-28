<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password Notification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, Helvetica, sans-serif; background: #f7f7f7; color: #333; }
        .container { max-width: 500px; margin: 30px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #eee; padding: 32px 24px; }
        .section-title { text-align: center; margin-bottom: 32px; }
        .section-title h1 { font-size: 2em; color: #007bff; margin: 0; }
        .section-title i { font-size: 2.5em; color: #28a745; margin-top: 10px; }
        .content { margin-bottom: 32px; }
        .btn { display: inline-block; background: #28a745; color: #fff !important; padding: 14px 32px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 1.1em; margin: 24px 0; }
        .btn:hover { background: #218838; }
        .footer { text-align: center; color: #888; font-size: 0.95em; margin-top: 32px; }
        .code { background: #f1f1f1; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
    </style>
</head>
<body>
    <div class="container">
        <div class="section-title">
            <h1>Password Reset</h1>
            <i class="fas fa-key"></i>
        </div>
        <div class="content">
            <p>
                Hello{{ isset($name) && $name ? ' ' . $name . '!' : '!' }}
            </p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <div style="text-align: center;">
                <a href="{{ $actionUrl }}" class="btn" target="_blank">Reset Password</a>
            </div>
            <p style="margin-top: 24px;">
                This password reset link will expire in <span class="code">{{ $expiration ?? config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutes</span>.<br>
                If you did not request a password reset, no further action is required.
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
