<?php
include_once("config.php");

$PaymentID = $_GET['PaymentID'];
$UserID = $_GET['UserID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $PaymentID = $_POST['PaymentID'];
    $CName = $_POST['CName'];
    $TCard = $_POST['TCard'];
    $CNumber = $_POST['CNumber'];
    $CExpire = $_POST['CExpire'];
    $UserID = $_GET['UserID'];

    // Insert data into pdetails table
    $sql = "INSERT INTO pdetails (PaymentID, CName, TCard, CNumber, CExpire) 
            VALUES ('$PaymentID', '$CName', '$TCard', '$CNumber', '$CExpire')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ploading.php?UserID=$UserID&PaymentID=" . $PaymentID);
    } else {
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
    <title>Payment</title>
<style rel="stylesheet">
    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgb(0, 0, 34);
        font-size: 1rem;
        background-image: url("img/heli4.jpg");
        background-size: cover;
        background-repeat: no-repeat;
    }
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .card {
        max-width: 600px;
        margin: 20px;
        background-color: #fff;
        border-radius: 10px;
    }
    .card-top { 
        font-size: 20px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center; 
    }
    .card-top a {
        float: none; 
        margin-top: 0; 
        color: #000; 
    }
    #logo {
        margin-top: 10px;
        width: 150px; 
        height: 120px;
        font-weight: bold;
        font-size: 30px;
        color: black; 
    }
    .card-body {
        padding: 2px 20px 10px 10px;
    }
    .row {
        margin: 0;
    }
    .upper{
        padding: 1rem 0;
        justify-content: space-evenly;
    }
    #three{
        border-radius: 1rem;
            width: 22px;
        height: 22px;
        margin-right:3px;
        border: 1px solid blue;
        text-align: center;
        display: inline-block;
    }
    #payment{
        margin:0;
        color: blue;
    }
    .icons{
        margin: 0px 0px 0px 10px;
    }
    form span{
        color: rgb(179, 179, 179);
    }
    form{
        padding: 2vh 0;
    }
    input{
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247);
    }
    input:focus::-webkit-input-placeholder
    {
        color:transparent;
    }
    .header{
        font-size: 1.5rem;
    }
    .left{
        background-color: #ffffff;
        padding: 2vh;   
    }
    .left img{
        width: 2rem;
    }
    .left .col-4{
        padding-left: 0;
    }
    .right .item{
        padding: 0.3rem 0;
    }
    .right{
        background-color: #ffffff;
        padding: 2vh;
    }
    .col-8{
        padding: 0 1vh;
    }
    .lower{
        line-height: 2;
    }
    .btn{
        background-color: rgb(23, 4, 189);
        border-color: rgb(23, 4, 189);
        color: white;
        width: 100%;
        font-size: 15px;
        padding: 9px;
        border-radius: 7px;
        margin-bottom: 10px;
    }
    .btn:focus{
        box-shadow: none;
        outline: none;
        box-shadow: none;
        color: white;
        transition: none; 
    }
    .btn:hover{
        color: white;
    }
    a{
        color: black;
    }
    a:hover{
        color: black;
        text-decoration: none;
    }
    input[type=checkbox]{
        width: unset;
        margin-bottom: unset;
    }
    #cvv{
        background-image: linear-gradient(to left, rgba(255, 255, 255, 0.575) ,/*  rgba(255, 255, 255, 0.541)), url("https://img.icons8.com/material-outlined/24/000000/help.png") */);
        background-repeat: no-repeat;
        background-position-x: 95%;
        background-position-y: center;
    }
</style>
</head>
<body>

<div class="card">
    <div class="card-top">
        <img id="logo" src="img/logo.png" >
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-7">
                <div class="left border">
                    <div class="row">
                        <center>
                        <div class="icons">
                            <img src="https://img.icons8.com/color/48/000000/visa.png"/>
                            <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png"/>
                            <img src="https://img.icons8.com/color/48/000000/maestro.png"/>
                        </div>
                        </center>
                    </div>
                    <form method="post" action="">
                        <input type="hidden" name="PaymentID" value="<?php echo $PaymentID ?>">
                        <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                        <span>Name:</span>
                        <input type="text" id="CName" name="CName" placeholder="Cardholder's name">
                        <span>Type Card:</span>
                        <input type="text" id="TCard" name="TCard" placeholder="VISA/Mastercard/Maestro">
                        <span>Card Number:</span>
                        <input type="number" id="CNumber" name="CNumber" placeholder="0129 1332 9132 xxxx" minlength="12" required>
                        <div class="row">
                            <div class="col-4"><span>Expire date:</span>
                                <input id="CExpire" name="CExpire" placeholder="YY/MM">
                            </div>
                        </div>
                        <button type="submit" class="btn">Checkout</button>
                    </form>
                </div>                        
            </div>
        </div>
    </div>
</div>
</body>
</html>