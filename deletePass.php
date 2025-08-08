<?php
include_once("config.php");

if(isset($_GET['PassengerID'])) {
    $PassengerID = $_GET['PassengerID'];

    $delete = mysqli_query($conn, "DELETE FROM bdetails WHERE PassengerID=$PassengerID");

    // Redirect to prevent form resubmission
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
} else {
    // Handle the case when PassengerID is not provided
    echo "Passenger ID is missing.";
}
?>
