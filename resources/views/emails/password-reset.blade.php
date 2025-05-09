<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #F7941D;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Password Reset Request</h2>
    
    <p>Hello,</p>
    
    <p>We received a request to reset your password. If you didn't make this request, you can safely ignore this email.</p>
    
    <p>To reset your password, click the button below:</p>
    
    <a href="{{ $resetUrl }}" class="button">Reset Password</a>
    
    <p>Or copy and paste this URL into your browser:</p>
    <p>{{ $resetUrl }}</p>
    
    <p>This password reset link will expire in 60 minutes.</p>
    
    <div class="footer">
        <p>If you have any questions, please contact our support team.</p>
        <p>This is an automated message, please do not reply to this email.</p>
    </div>
</body>
</html> 