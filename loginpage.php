<?php
session_start(); // Start session
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE Username = '$username' AND Password = '$password'";
    
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['loggedin'] = true; // Set session variable to indicate user is logged in
        $_SESSION['UserID'] = $row['UserID']; // Store userID in session
        header("Location: homepagee.php?UserID=" . $row['UserID']); // Redirect to homepage with userID in URL
        exit();
    } else {
        echo "<script>alert('Invalid username or password. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; 
            background: #4B0303 url('img/heli4.jpg');
            background-size: cover;
        }

        .wrapper {
            width: 420px;
            background: white;
            border: 2px solid black;
            backdrop-filter: blur(20px);
            color: black;
            border-radius: 10px;
            padding: 30px 40px; 
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center; 
            margin-bottom: 30px;
        }

        .input-box {
            position: relative; 
            width: 100%;
            height: 50px;
            margin: 30px 0; 
        }

        .input-box input {
            width: 100%;
            height: 50px;
            background: transparent;
            font-size: 16px;
            color: black; 
            padding: 20px 45px 20px 20px;    
            border: 2px solid black;
            border-radius: 40px;
            box-sizing: border-box;
        }

        .input-box input::placeholder {
            color: black;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .wrapper .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input {
            accent-color: white;
            margin-right: 2px;
        }

        .remember-forgot a {
            color: black;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .wrapper button {
            width: 100%;
            height: 45px;
            background: white; 
            border: 2px solid black;
            border-radius: 40px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            color: #333;
            font-weight: 600;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin-bottom: 15px;
        }

        .register-link p a {
            color: black;
            text-decoration: none;
            font-weight: 600;
        }

        .show-password {
            font-size: 10px;
            display: inline-block;
            cursor: pointer;
        }

        span {
            margin-left: 250px ;
            font-family: "Poppins", sans-serif;
            cursor: pointer;
        }

        span:hover {
            text-decoration: underline;
        }

        .input-box.active {
            border-color: #1e00ff; 
            box-shadow: 0 0 10px #1e00ff;
            border-radius: 40px;
        }

        .input-box.active i {
            color: #1e00ff;
        }
</style>
    <script>
        $(document).ready(function () {
            $('.input-box input').focus(function () {
                $(this).parent().addClass('active');
            });

            $('.input-box input').blur(function () {
                if ($(this).val() === '') {
                    $(this).parent().removeClass('active');
                }   
            });

            $('.show-password').click(function () {
                const passwordField = $(this).siblings('input');
                const fieldType = passwordField.attr('type');

                if (fieldType === 'password') {
                    passwordField.attr('type', 'text');
                } else {
                    passwordField.attr('type', 'password');
                }
            });
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" required>
                <i class='bx bxs-user'></i> 
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" required name="password">
                <i class='bx bxs-lock-alt'></i>
                <span class="show-password">show password</span>
            </div>

            <button type="submit" class="button">Login</button>
        </form>
    </div>
</body>
</html>
