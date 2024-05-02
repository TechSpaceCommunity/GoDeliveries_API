<!-- login_success.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Successful</title>
    <style>
        body {
            background-color: #FE724C;
            font-family: Arial, sans-serif;
            text-align: center;
            color: white;
        }
        h1 {
            margin-top: 50px;
        }
        p {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Login Successful!</h1>
    <p>You will be redirected to our app shortly. If not, <a id="appLink" href="#">click here</a>.</p>
    <p id="countdown">5</p>
    <script>
        var count = 5;
        var countdown = setInterval(function() {
            count--;
            document.getElementById('countdown').textContent = count;
            if (count <= 0) {
                clearInterval(countdown);
                redirectToApp();
            }
        }, 1000);

        // Redirect to the app
        function redirectToApp() {
            var userId = "{{ $user->id }}";
            var userName = "{{ $user->name }}";
            var userEmail = "{{ $user->email }}";
            var profilePic = "{{ $user->profile_pic }}";
            var userToken = "{{ $user->api_token }}";

            // Construct the app URL with query parameters
            var appURL = "exp://192.168.100.159:8081/?" +
                         "user_id=" + userId +
                         "&user_name=" + userName +
                         "&user_email=" + userEmail +
                         "&profile_pic=" + profilePic +
                         "&user_token=" + userToken;

            document.getElementById('appLink').setAttribute('href', appURL);

            window.location.href = appURL;
        }
    </script>
</body>
</html>
