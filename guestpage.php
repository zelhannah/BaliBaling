<?php
include_once("config.php");

// Initialize UserID variable
$userID = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];

    // Insert the data into the user table
    $sql = "INSERT INTO user (FirstName, Email, Phone) VALUES ('$name', '$email', '$phone')";
    if (mysqli_query($conn, $sql)) {
        // Retrieve the auto-generated UserID
        $userID = mysqli_insert_id($conn);

        // Redirect to homepage.php with UserID appended to the URL
        header("Location: homepagee.php?UserID=$userID");
        exit();
    } else {
        // Display an error message if insertion fails
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest</title>

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
            height: 100%;
            background: transparent;
            font-size: 16px;
            color: black; 
            padding: 20px 45px 20px 20px;    
            border: 2px solid black;
            border-radius: 40px;
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

        .input-box.active {
            border-color: #1e00ff; 
            box-shadow: 0 0 10px #1e00ff;
            border-radius: 40px;
        }

        .input-box.active i {
            color: #1e00ff;
        }
</style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

        });
    </script>
</head>
<body>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <h1>Guest Page</h1>
            <div class="input-box">
                <input type="text" placeholder="Name" name="Name" required>
            </div>
            <div class="input-box">
                <input type="email" placeholder="Email" name="Email" required>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Phone" name="Phone" required>
            </div>
            
            <button type="submit" class="button">Continue</button>
        </form>
    </div>
</body>
</html>
