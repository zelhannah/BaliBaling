<?php
  include_once("config.php");
  
  if (isset($_GET['PaymentID'])) {
    $PaymentID = $_GET['PaymentID'];
    $UserID = $_GET['UserID'];

    $sql = "UPDATE payment SET PaymentStatus='SUCCESS' WHERE PaymentID='$PaymentID'";

    if ($conn->query($sql) === TRUE) {
        // Success message
        echo "";
    } else {
        // Error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loading</title>
  <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url(./img/heli4.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            text-align: center;
            display: flex;
            justify-content: center;
            margin-top: 200px;
            color: #000; 
        }

        .container {
            max-width: 500px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0px 20px 80px rgba(0, 0, 0, 0.4);
        }

        .header {
            color: black;
            font-size: 30px;
            margin-bottom: 30px;
            text-shadow: 3px 3px 3px rgba(0,0,0,0.5);
        }

        .message {
            color: black;
            font-size: 20px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 2px rgba(0,0,0,0.5);
        }

        .spinner {
            display: inline-block;
            width: 50px;
            height: 50px;
            border: 6px solid rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            border-top-color:black;
            animation: spin 2s linear infinite;
            margin-bottom: 40px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="header">Thank You for Your Purchase!</h1>
    <p class="message">Please wait while we redirect you...</p>
    <div class="spinner"></div>
  </div>
  <script>
    setTimeout(function(){
      window.location.href = "psuccess.php?UserID=<?php echo $UserID; ?>&PaymentID=<?php echo $PaymentID; ?>";
    }, 2000);
  </script>
</body>
</html>