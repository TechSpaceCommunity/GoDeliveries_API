<!-- login_success.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Successful</title>
    <style>
        body {
            background-color: #FE724C; /* Set background color */
            font-family: Arial, sans-serif; /* Set font family */
            text-align: center; /* Center align text */
            color: white; /* Set text color to white */
        }
        h1 {
            margin-top: 50px; /* Add some margin to the top of the h1 element */
        }
        p {
            margin-top: 20px; /* Add some margin to the top of the p element */
        }
    </style>
</head>
<body>
    <h1>Login Successful!</h1>
    <p>You will be redirected to our app shortly. If not, <a href="exp://exp.host/@godeliveries/godeliveriesapp/?user_id={{ $user->id }}&user_name={{ $user->name }}&user_email={{ $user->email }}&profile_pic={{ $user->profile_pic }}&user_token={{ $user->api_token }}">click here</a>.</p>
    <p id="countdown">5</p>
    <script>
        // Countdown timer
        var count = 5;
        var countdown = setInterval(function() {
            count--;
            document.getElementById('countdown').textContent = count;
            if (count <= 0) {
                clearInterval(countdown);
                window.location.href = '/redirect-to-app'; // Redirect to React Native app
            }
        }, 1000);
    </script>
</body>
</html>