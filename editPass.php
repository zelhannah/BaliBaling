<?php
include_once("config.php");

$UserID = $_GET['UserID'];
$BookingID = $_GET['BookingID'];
$Passengers = $_GET['Passengers']; 

if(isset($_POST['update'])) {
    $UserID = $_GET['UserID'];
    $BookingID = $_GET['BookingID'];
    $Passengers = $_GET['Passengers']; 

    $PassengerID = $_POST['PassengerID'];
    $PassengerName = $_POST['PassengerName'];
    $PassengerAge = $_POST['PassengerAge'];
    $PassengerWeight = $_POST['PassengerWeight'];
    $PassengerHeight = $_POST['PassengerHeight'];

    $result = mysqli_query($conn, "UPDATE bdetails SET PassengerName='$PassengerName',PassengerAge='$PassengerAge',PassengerWeight='$PassengerWeight',PassengerHeight='$PassengerHeight' WHERE PassengerID='$PassengerID'");

    header("Location: bdetails.php?UserID=$UserID&BookingID=$BookingID&Passengers=$Passengers?#passenger-list");
}

$PassengerID = $_GET['PassengerID'];
$result = mysqli_query($conn, "SELECT * FROM bdetails WHERE PassengerID='$PassengerID'");

while($bdetails = mysqli_fetch_array($result)) {
    $PassengerName = $bdetails['PassengerName'];
    $PassengerAge = $bdetails['PassengerAge'];
    $PassengerWeight = $bdetails['PassengerWeight'];
    $PassengerHeight = $bdetails['PassengerHeight'];
}
?>

<html>
<head>
    <title>Edit Passenger</title>
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
    background-image: url('https://cdn.kimkim.com/files/a/images/67110969877d9e2f4d97be2a2990c75f7a443591/original-a3ba719300ea6e2a13f2e564a02005d9.jpg');
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

    .booking-form input[type="date"].form-control {
        padding-top: 16px;
    }

    .booking-form input[type="date"].form-control:invalid {
        color: rgba(255, 255, 255, 0.5);
    }

    .booking-form input[type="date"].form-control+.form-label {
        opacity: 1;
        top: 10px;
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
</style>
</head>

<body>
<div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
                        <div class="form-header">
                            <h1>edit passenger information</h1>
                        </div>
                        <form id="passenger-form" action="bdetails.php?UserID=<?php echo $UserID ?>&BookingID=<?php echo $BookingID?>&Passengers=<?php echo $Passengers?>#passenger-list" method="post">
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
                                <input type="hidden" name="PassengerID" value="<?php echo $_GET['PassengerID']; ?>"></td>
                                <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                                <input type="hidden" name="BookingID" value="<?php echo $BookingID; ?>">
                                <button class="submit-btn" type="submit" name="update">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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

    <footer id="footer">
        <iframe src="footer.php" frameborder="0" width="100%" height="200"></iframe>
    </footer>
</body>
</html>