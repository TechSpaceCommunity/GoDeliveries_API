<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Account Details</title>
</head>
<body>
    <h1>Restaurant Account Details</h1>
    <p>Hello,</p>
    <p>Your Restaurant account has been created successfully. Here are your account details:</p>
    <ul>
        <li><strong>Email:</strong> {{ $userData['email'] }}</li>
        <li><strong>Password:</strong> {{ $userData['password'] }}</li>
    </ul>

    <p>You can now use these credentials to log in to your Restaurant account.</p>
    <p>Thank you!</p>

    <p>If you want to login now, <a href="{{ appurl }}/restaurantslogin" style="color: orange;">click here</a>.</p>
</body>
</html>
