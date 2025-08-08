<?php
  include_once("config.php");

  $PaymentID = $_GET['PaymentID'];
  $UserID = $_GET['UserID'];

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url(./img/heli4.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container {
            width: 450px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #008000;
        }
        p {
            color: #333;
            margin-bottom: 20px;
        }
        .button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Successful!</h1>
        <p>Thank you for your purchase.</p>
        <p>Your order has been successfully processed.</p>
        <a href="history.php?UserID=<?php echo $UserID; ?>" class="button">Continue</a>
    </div>
</body>
</html>
