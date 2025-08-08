<?php
include_once("config.php");

// get the userid, bookingid & passengers from url
$UserID = $_GET['UserID'];
$BookingID = $_GET['BookingID'];
$Passengers = $_GET['Passengers']; 

$passengerCount = intval(mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM bdetails WHERE BookingID='$BookingID'"))['total']);

$remainingSlots = intval($Passengers) - $passengerCount;

// check if the remaining slots are less than or equal to 0
if ($remainingSlots < 1) {
    $formDisabled = true;
} else {
    $formDisabled = false;
}

$buttonText = $remainingSlots <= 0 ? "Done" : "Add Passenger";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $PassengerID = $_POST['PassengerID'];
        $PassengerName = $_POST['PassengerName'];
        $PassengerAge = $_POST['PassengerAge'];
        $PassengerWeight = $_POST['PassengerWeight'];
        $PassengerHeight = $_POST['PassengerHeight'];

        if (!$formDisabled) {
            $result = mysqli_query($conn, "INSERT INTO bdetails(BookingID, PassengerID, PassengerName, PassengerAge, PassengerWeight, PassengerHeight)
            VALUES('$BookingID','$PassengerID','$PassengerName','$PassengerAge','$PassengerWeight','$PassengerHeight')");

            if ($result) {
                echo "";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}

if(isset($_GET['BookingID'])) {
    $bookingID = $_GET['BookingID'];
    $fetch = mysqli_query($conn, "SELECT * FROM bdetails WHERE BookingID = '$bookingID'");
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="bootstrap.min.css"/>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .section {
    position: relative;
    height: 100vh;
    }

    .section .section-center {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    }

    #booking {
    font-family: 'Raleway', sans-serif;
    }

    .booking-form {
    position: relative;
    max-width: 642px;
    width: 100%;
    margin: auto;
    padding: 40px;
    overflow: hidden;
    background-image: url('https://a.cdn-hotels.com/gdcs/production75/d966/8994658f-13ad-4106-bde4-856450359f47.jpg');
    background-size: cover;
    border-radius: 5px;
    z-index: 20;
    }

    .booking-form::before {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    background: rgba(0, 0, 0, 0.7);
    z-index: -1;
    }

    .booking-form .form-header {
    text-align: center;
    position: relative;
    margin-bottom: 30px;
    }


    .booking-form .form-header h1 {
    font-weight: 700;
    text-transform: capitalize;
    font-size: 42px;
    margin: 0px;
    color: #fff;
    }

    .booking-form .form-group {
    position: relative;
    margin-bottom: 30px;
    }

    .booking-form .form-control {
    background-color: rgba(255, 255, 255, 0.2);
    height: 60px;
    padding: 0px 25px;
    border: none;
    border-radius: 40px;
    color: #fff;
    -webkit-box-shadow: 0px 0px 0px 2px transparent;
    box-shadow: 0px 0px 0px 2px transparent;
    -webkit-transition: 0.2s;
    transition: 0.2s;
    }

    .booking-form .form-control::-webkit-input-placeholder {
    color: rgba(255, 255, 255, 0.5);
    }

    .booking-form .form-control:-ms-input-placeholder {
    color: rgba(255, 255, 255, 0.5);
    }

    .booking-form .form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
    }

    .booking-form .form-control:focus {
    -webkit-box-shadow: 0px 0px 0px 2px #ff8846;
    box-shadow: 0px 0px 0px 2px #ff8846;
    }

    .booking-form select.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    }

    .booking-form select.form-control:invalid {
    color: rgba(255, 255, 255, 0.5);
    }

    .booking-form select.form-control+.select-arrow {
    position: absolute;
    right: 15px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    width: 32px;
    line-height: 32px;
    height: 32px;
    text-align: center;
    pointer-events: none;
    color: rgba(255, 255, 255, 0.5);
    font-size: 14px;
    }

    .booking-form select.form-control+.select-arrow:after {
    content: '\279C';
    display: block;
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
    }

    .booking-form select.form-control option {
    color: #000;
    }

    .booking-form .form-label {
    position: absolute;
    top: -10px;
    left: 25px;
    opacity: 0;
    color: #ff8846;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.3px;
    height: 15px;
    line-height: 15px;
    -webkit-transition: 0.2s all;
    transition: 0.2s all;
    }

    .booking-form .form-group.input-not-empty .form-control {
    padding-top: 16px;
    }

    .booking-form .form-group.input-not-empty .form-label {
    opacity: 1;
    top: 10px;
    }

    .booking-form .submit-btn {
    color: #fff;
    background-color: lightblue;
    font-weight: 700;
    height: 60px;
    padding: 10px 30px;
    width: 100%;
    border-radius: 40px;
    border: none;
    text-transform: uppercase;
    font-size: 16px;
    letter-spacing: 1.3px;
    -webkit-transition: 0.2s all;
    transition: 0.2s all;
    }

    .booking-form .submit-btn:hover,
    .booking-form .submit-btn:focus {
        opacity: 0.9;
    }

    #passenger-list {
        margin-bottom: 35px;
    }

    #passenger-list table {
        border-collapse: collapse;
        width: 100%;
        border-radius: 10px; 
        overflow: hidden;
    }

    #passenger-list th,
    #passenger-list td {
        padding: 8px;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:nth-child(odd) {
        background-color: #D6EEEE;
    }


</style>
</head>
<body>
    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
                        <div class="form-header">
                            <h1>passenger information</h1>
                        </div>
                        <form id="passenger-form" action="bdetails.php?UserID=<?php echo $UserID; ?>&BookingID=<?php echo $BookingID; ?>&Passengers=<?php echo $Passengers; ?>" method="post">
                            <div class="form-group">
                                <input class="form-control" type="text" name="PassengerID" placeholder="ID/KTP/Passport" required>
                                <span class="form-label">Passenger ID</span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="PassengerName" placeholder="Full Name" required>
                                <span class="form-label">Passenger Name</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="PassengerAge" placeholder="Age" required>
                                        <span class="form-label">Passenger Age</span>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="PassengerWeight" placeholder="Weight" required>
                                        <span class="form-label">Passenger Weight</span>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="PassengerHeight" placeholder="Height" required>
                                        <span class="form-label">Passenger Height</span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-btn">
                                <button class="submit-btn" type="submit" name="submit" <?php if ($formDisabled) echo "disabled"; ?>>
                                    <?php echo $buttonText; ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style='padding: 50px;'>
    <div id="passenger-list">
        <table id="passenger-table">
            <tr>
                <th>Passenger ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Weight</th>
                <th>Height</th>
                <th>Actions</th>
            </tr>
            <?php
            if(isset($fetch)) {
                while ($row = mysqli_fetch_assoc($fetch)) {
                    echo "<tr>";
                    echo "<td>" . $row['PassengerID'] . "</td>";
                    echo "<td>" . $row['PassengerName'] . "</td>";
                    echo "<td>" . $row['PassengerAge'] . "</td>";
                    echo "<td>" . $row['PassengerWeight'] . "</td>";
                    echo "<td>" . $row['PassengerHeight'] . "</td>";
                    echo  "<td> <a href='editPass.php?PassengerID=" . $row['PassengerID'] . "&UserID=" . $UserID . "&BookingID=" . $BookingID . "&Passengers=" . $Passengers . "'>Edit</a>
                    | <a href='deletePass.php?PassengerID=" . $row['PassengerID'] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <?php if ($remainingSlots == 0): ?>
    <div class="form-btn">
        <a href="payment.php?UserID=<?php echo $UserID;?>&BookingID=<?php echo $BookingID; ?>&Passengers=<?php echo $Passengers; ?>" class="submit-btn">Proceed to Payment</a>
    </div>
    <?php endif; ?>
    </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script>
        $('.form-control').each(function () {
            floatedLabel($(this));
        });

        $('.form-control').on('input', function () {
            floatedLabel($(this));
        });

        function floatedLabel(input) {
            var $field = input.closest('.form-group');
            if (input.val()) {
                $field.addClass('input-not-empty');
            } else {
                $field.removeClass('input-not-empty');
            }
        }
    </script>
</body>
</html>
