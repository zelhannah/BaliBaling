<?php
include_once("config.php");

// initialize variables
$trip_prices = array();
$subtotal = 0;
$percent_tax = 0.2;
$tax = 0;
$total = 0;
$PaymentStatus = "pending";

if (isset($_GET['BookingID'], $_GET['Passengers'])) {
    $BookingID = $_GET['BookingID'];
    $Passengers = $_GET['Passengers'];

    $sql = "SELECT b.TripID, t.tripName, t.price, b.TripDate, b.TripTime
    FROM booking b
    JOIN trips t ON b.TripID = t.TripID
    WHERE b.BookingID = '$BookingID'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
    } else {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $trip_prices[] = array(
                    'tripName' => $row['tripName'],
                    'price' => $row['price'],
                    'TripDate' => $row['TripDate'],
                    'TripTime' => $row['TripTime']
                );
            }
        } 
    } 

    // calculate subtotal, tax (20%), and total
    $subtotal = array_sum(array_column($trip_prices, 'price'));
    $tax = $subtotal * $percent_tax;
    $total = $subtotal + $tax;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserID = $_GET['UserID'];
    $BookingID = $_GET['BookingID'];
    $Price = $subtotal;
    $Tax = $tax;
    $FinalAmount = $total;

    $sql = "INSERT INTO payment (BookingID, Price, Tax, FinalAmount, PaymentStatus) 
    VALUES ('$BookingID', '$Price', '$Tax', '$FinalAmount', '$PaymentStatus')";

    if (mysqli_query($conn, $sql)) {
        echo "Payment recorded successfully.";
            $paymentID = mysqli_insert_id($conn);
            // Redirect to another page with PaymentID in the URL
            header("Location: pstatus.php?UserID=$UserID&PaymentID=$paymentID");
            exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYMENT</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url(img/heli4.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            color: #000;
        }
        .payment-page-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            margin-top: 10px;
        }
        .wrapper {
            color: black;
            font-size: 20px;
        }
        .panel {
            border-radius: 10px;
            background-color: #fff;
            padding: 20px; 
        }
        .price {
            font-size: 20px;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            background-color: #4caf50;
            color: black;
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
        td {
            text-align: right;
        }
        
    </style>
</head>
<body>
<div class="container wrapper">
    <div class="row cart-head">
        <div class="container">
            <center><img id="logo" src="img/logo.png" style="width: 15%; length: 15%; padding: 10px;" ></center>
        </div>
    </div> 
    <div class="row cart-body">
        <form class="form-horizontal" method="post" action="payment.php?UserID=<?php echo isset($_GET['UserID']) ? $_GET['UserID'] : ''; ?>&BookingID=<?php echo isset($_GET['BookingID']) ? $_GET['BookingID'] : ''; ?>&Passengers=<?php echo isset($_GET['Passengers']) ? $_GET['Passengers'] : ''; ?>">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!-- Payment Details -->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Payment Details 
                    </div>
                    <div class="panel-body">
                        <?php if (!empty($trip_prices)): ?>
                            <?php foreach ($trip_prices as $tripData): ?>
                                <div class="form-group">
                                    <div class="col-sm-9 col-xs-9">
                                    <input type="hidden" name="BookingID" value="<?php echo isset($_GET['BookingID']) ? $_GET['BookingID'] : ''; ?>">
                                        <div class="col-xs-12"><?php echo $tripData['tripName']; ?></div>
                                        <div class="col-xs-12"><small>Date: <?php echo $tripData['TripDate']; ?></small></div>
                                        <div class="col-xs-12"><small>Time: <?php echo $tripData['TripTime']; ?></small></div>
                                        <div class="col-xs-12"><small>Total Passengers: <?php echo $Passengers; ?></small></div>
                                    </div>
                                    <div class="col-sm-3 col-xs-3 text-right">
                                        <h6 class="price"><span>IDR</span><?php echo number_format($tripData['price'], 2); ?></h6>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No trip data available.</p>
                        <?php endif; ?>
                    </div>
                    <!-- Payment Summary -->
                    <table class="table">
                        <tr>
                            <th>Subtotal</th>
                            <td>IDR<?php echo number_format($subtotal, 2); ?></td>
                        </tr>
                        <tr>
                            <th>Tax (<?php echo ($percent_tax * 100); ?>%)</th>
                            <td>IDR<?php echo number_format($tax, 2); ?></td>
                        </tr>
                        <tr>
                            <th><strong>Total Order</strong></th>
                            <td>IDR<?php echo number_format($total, 2); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="button-container">
                    <center><button type="submit" class="button" name="submit">Pay Now</button></center>
                </div> 
            </div>
        </form>
    </div>
</div>
</body>
</html>