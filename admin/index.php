<?php
    session_start();

    if (isset($_SESSION['username'])) {
        header('Location: admin_welcome.php');
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container button {
            padding: 10px 15px;
            background-color: #5cb85c;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-container .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <div class="error"></div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $('#login-form').on('submit', function(e){
                e.preventDefault();
                let username = $('#username').val();
                let password = $('#password').val();
                $.ajax({
                    type: 'POST',
                    url: 'login.php',
                    data: {username: username, password: password},
                    success: function(response){
                        if(response === 'success'){
                            window.location.href = 'admin_welcome.php';
                        } else {
                            $('.error').text(response);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
