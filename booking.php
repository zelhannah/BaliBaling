<?php
include_once("config.php");

$TripID = $_GET['TripID'];
$UserID = $_GET['UserID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TripDate = $_POST['TripDate'];
    $TripTime = $_POST['TripTime'];
    $adults = $_POST['adults'];
    $kids = $_POST['kids'];
    $Passengers = $adults + $kids;

    $sql = "INSERT INTO booking (UserID, TripID, TripDate, TripTime, Passengers, BookingDate) 
	VALUES ('$UserID','$TripID', '$TripDate', '$TripTime', '$Passengers', NOW())";

    if ($conn->query($sql) === TRUE) {
        $BookingID = $conn->insert_id;
        
        // Pass the total number of passengers as a URL parameter
        header("Location: bdetails.php?UserID=$UserID&BookingID=$BookingID&Passengers=$Passengers");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Booking Page</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Alegreya:700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="bootstrap.min.css" />

<style>
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
	font-family: 'Source Sans Pro', sans-serif;
	background-image: url('https://flybaliheli.com/wp-content/themes/public/assets/images/slider/resized/slide12.jpg');
	background-size: cover;
	background-position: center;
	}

	.booking-form {
	background: #fff;
	-webkit-box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.3);
	box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.3);
	border: 1px solid rgba(60, 64, 101, 0.1);
	}

	.booking-form>form .row.no-margin {
	margin-right: 0px;
	margin-left: 0px;
	}

	.booking-form>form .row.no-margin>[class*="col-"] {
	padding-right: 0px;
	padding-left: 0px;
	}

	.booking-form .form-header {
	padding: 15px 10px;
	height: 110px;
	line-height: 110px;
	text-align: center;
	}

	.booking-form .form-header h2 {
	font-family: 'Alegreya', serif;
	margin: 0;
	display: inline-block;
	font-size: 52px;
	color: lightblue;
	}

	.booking-form .form-group {
	position: relative;
	height: 110px;
	padding: 15px 10px;
	margin-bottom: 0px;
	}

	.booking-form .form-control {
	font-family: 'Alegreya', serif;
	background-color: transparent;
	border-radius: 0px;
	border: none;
	height: 50px;
	-webkit-box-shadow: none;
	box-shadow: none;
	padding: 0;
	font-size: 28px;
	color: #3c404a;
	font-weight: 700;
	}

	.booking-form select.form-control {
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	}

	.booking-form select.form-control+.select-arrow {
	position: absolute;
	right: 0px;
	bottom: 20px;
	width: 32px;
	line-height: 32px;
	height: 32px;
	text-align: center;
	pointer-events: none;
	color: #818390;
	font-size: 12px;
	}

	.booking-form select.form-control+.select-arrow:after {
	content: '\279C';
	display: block;
	-webkit-transform: rotate(90deg);
	transform: rotate(90deg);
	}

	.booking-form .form-label {
	color: #818390;
	display: block;
	font-weight: 400;
	height: 30px;
	line-height: 30px;
	font-size: 14px;
	}

	.booking-form .form-btn {
	padding: 15px 10px;
	height: 110px;
	}

	.booking-form .submit-btn {
	background: lightblue;
	color: #fff;
	border: none;
	font-weight: 600;
	text-transform: uppercase;
	font-size: 14px;
	display: block;
	height: 80px;
	width: 100%;
    font-size: 25px;
    font-family: 'Alegreya', serif;
	}

	.booking-form .form-group.kids {
    opacity: 0.5;
    pointer-events: none;
	}
</style>
</head>

<body>
    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
						<form action="booking.php?UserID=<?php echo isset($_GET['UserID']) ? $_GET['UserID'] : ''; ?>&TripID=<?php echo isset($_GET['TripID']) ? $_GET['TripID'] : ''; ?>" method="POST">
                            <div class="row no-margin">
                                <div class="col-md-3">
                                    <div class="form-header">
                                        <h2>Book Now</h2> 
                                    </div>
                                </div>
								<input type="hidden" name="UserID" value="<?php echo isset($_GET['UserID']) ? $_GET['UserID'] : ''; ?>">
								<input type="hidden" name="TripID" value="<?php echo isset($_GET['TripID']) ? $_GET['TripID'] : ''; ?>">
                                <div class="col-md-7">
                                    <div class="row no-margin">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="form-label">Date</span>
                                                <input class="form-control" type="date" name="TripDate"> 
												
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="form-label">Time</span>
                                                <input class="form-control" type="time" name="TripTime"> 
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <span class="form-label">Adults</span>
                                                <select class="form-control" name="adults">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                                <span class="select-arrow"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <span class="form-label">Kids</span>
                                                <select class="form-control" name="kids">
                                                    <option>0</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                                <span class="select-arrow"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-btn">
                                        <button type="submit" class="submit-btn" href="">NEXT</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const adultSelect = document.querySelector('.booking-form select[name="adults"]');
            const kidSelect = document.querySelector('.booking-form select[name="kids"]');

            adultSelect.addEventListener('change', () => {
                const selectedAdults = parseInt(adultSelect.value);
                const maxKids = 4 - selectedAdults; 

                let kidOptions = '';
                for (let i = 0; i <= maxKids; i++) {
                    kidOptions += `<option value="${i}">${i}</option>`;
                }
                kidSelect.innerHTML = kidOptions;

                if (selectedAdults === 3 && parseInt(kidSelect.value) > 1) {
                    kidSelect.value = 1;
              }
              
              kidSelect.querySelectorAll('option').forEach(option => {
                option.disabled = parseInt(option.value) > maxKids;
            });
        });
    });
    </script>
</body>

</html>