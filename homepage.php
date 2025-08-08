<?php
session_start(); 
include_once("config.php");

$query = "SELECT * FROM trips";
$result = mysqli_query($conn, $query);

if(isset($_GET['UserID'])) {
  $UserID = $_GET['UserID'];
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

<style>
    body {
            background-color: white;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .content1 {
            background-color: white;
            position: relative;
            padding: 20%;
        }

        .web-caption {
          margin-left: 40px;
        }

        .slider {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .product {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: left;
        overflow: hidden;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        margin: 20px;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        
    }

    .product img:hover {
        transform: scale(1.1);
    }

    .product img {
        max-width: 100%;
        height: auto;
        transition: transform 5s ease;
    }

    .product h3 {
        margin: 10px 0;
        font-size: 1.5em;
        color: #333;
    }

    .product p {
        color: #666;
    }
    .product .booking-button {
        background-color: black;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        margin-top: 20px;
        cursor: pointer;
    }

    .product .booking-button:hover {
        background-color: #2980b9;
    }

    .product:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    }

    .slick-slide {
        width: calc(25% - 20px);
    }

    .slick-slide img {
        width: 100%;
        height: auto;
    }

    .booking-button {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: navy;
        color: white;
        width: 335px;
        height: 50px;
        margin: auto;
        text-decoration: none;
    }

    footer {
      background-color: lightblue;
      width: 100%;
      bottom: 0;
      padding: 50px 0 30px;
      border-top-left-radius: 125px;
      font-size: 13px;
    }

    .row {
      width: 85%;
      margin: auto;
      display: flex;
      flex-wrap: wrap;
      align-items: flex-start;
      justify-content: space-between;
    }

    #logo {
      color: black;
      font-size: 35px;
      font-weight: bold;
    }
    
    .col {
      flex-basis: 25%;
      padding: 10px;
    }

    .col h5 {
      width: fit-content;
      position: relative;
    }

    td {
      padding: 2px;
    }

    nav {
      text-decoration: none;
      background: white;
    }

    .navbar {
      padding-right: 15px;
      padding-left: 15px;
    }

    .navdiv {
      display: flex;
      align-items: center;
      margin-top: 5px;
    }

    .logox {
      font-size: 35px;
      font-weight: 600;
      color: black;
      margin-left: 20px;
      margin-right: 20px;
    }
    ul {
      display: flex;
      margin-top: 15px;
      margin-left: 275px;
    }

    li {
      list-style: none;
      display: inline-block;
    }

    li a {
      color: black;
      font-size: 18px;
      font-weight: thin;
      margin-right: 25px;
      text-decoration: none;
    }

    .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: black;
            padding: 20px;
            border-radius: 10px;
            z-index: 999;
            box-shadow: 0 0 10px black;
            color:white;
        }

        .popup-content {
            text-align: center;
        }

        .close {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
        }

        .button {
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 5px;
        }

        .button1 {
            background-color: #ffffff;
            color: black;
            border: 2px solid #04AA6D;
            margin-right: 10px;
        }

        .button1:hover {
            background-color: rgba(20, 242, 17, 0.79);
            border: 2px solid #246C4E;
        }

        .button2 {
            background-color: #efefef;
            color: black;
            border: 2px solid #008CBA;
        }

        .button2:hover {
            background-color: rgba(8, 66, 245, 0.8);
            border: 2px solid #005F7F;
        }

</style>

    <title>Homepage</title>
</head>

<body>
  <div class="popup" id="userPopup" style="display: none;">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Choose one to continue scrolling!</h2>
            <div class="button-container">
                <a href="loginpage.php?UserID=<?php echo isset($_GET['UserID']) ? $_GET['UserID'] : ''; ?>"><button class="button button1">Login</button></a>
                <form action="guestpage.php" method="get">
                    <button class="button button2" type="submit">Guest</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function(){
                document.getElementById("userPopup").style.display = "block";
            }, 1500);
        });

        function closePopup() {
            document.getElementById("userPopup").style.display = "none";
        }
    </script>

    <nav class="navbar">
      <div class="navdiv">
        <div class="logox"></div>
            <img src="img/logo.png" alt="BaliBaling Logo" style="width: 100px; height: 70px;"> 
        <ul>
          <li><a href="#carouselBali">HOME</a></li>
          <li><a href="#tours">TOURS</a></li>
          <li><a href="#footer">ABOUT</a></li>
        </ul>
        </div>
      </div>
    </nav>
    <br> <br> <br>
<div id="carouselBali" class="carousel slide" style="margin-top: -5%;">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselBali" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselBali" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselBali" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselBali" data-bs-slide-to="3" aria-label="Slide 4"></button>
          <button type="button" data-bs-target="#carouselBali" data-bs-slide-to="4" aria-label="Slide 5"></button>
       </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/heli1.jpg" class="d-block w-100" alt="Scenery of Bali">
          </div>
          <div class="carousel-item">
            <img src="img/sce1.jpg" class="d-block w-100" alt="Yellow Helicopter">
          </div>
          <div class="carousel-item">
            <img src="img/sce2.jpg" class="d-block w-100" alt="Scenery of Bali">
          </div>
          <div class="carousel-item">
            <img src="img/heli2.jpg" class="d-block w-100" alt="Red Helicopter">
          </div>
          <div class="carousel-item">
            <img src="img/sce3.jpg" class="d-block w-100" alt="Scenery of Bali">
          </div>
          <div class="carousel-caption">
            <h1>Welcome to BaliBaling</h1>
            <p>the best helicopter trip to discover the beauty of Bali in new angle</p>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselBali" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselBali" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <br/><br/><br/>
      <div class="web-caption" id="tours">
        <h1>Your Adventure Starts Here</h1>
        <p style="margin-right:50px;"> Embark on an unforgettable adventure with BaliBaling! Soar above the breathtaking landscapes of Bali 
          as you take in panoramic views of lush rice terraces, pristine beaches, and iconic landmarks. Feel the rush of 
          adrenaline as you glide through the sky, capturing Instagram-worthy moments from a whole new perspective. Our experienced
          pilots ensure a safe and thrilling journey, making this an experience you'll cherish forever. Get ready
          to create memories that will leave you floating on cloud nine. <strong>See you on BaliBaling!</strong>
        </p>
      </div>

      <div class="slider">
    <?php
    // Loop through each row fetched from the database
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="product">';
        echo '<img src="img/' . $row['IMG'] . '" alt="' . $row['IMG'] . '">';
        echo '<br>';
        echo '<h3><strong>' . $row['TripName'] . '</strong> (' . $row['Duration'] . 'm)</h3>';
        echo '<p>'. $row['Destination']. '</p>';
        echo '<hr>';
        echo '<h3>IDR ' . number_format($row['Price']) . '</h3>'; 
        echo '<p style="margin-top: -10px;">per helicopter (up to four passengers)';
        echo '<a href="booking.php?&TripID=' . $row['TripID'] . '" class="booking-button">Book Now</a>';
        echo '</div>';
    }
    ?>
</div>
<br>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
$(document).ready(function(){
    $('.slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 10000, 
        speed: 800,
        easing: 'ease',
        pauseOnHover: false
    });
});
</script>

<footer id="footer">
  <div class="row">
    <div class="col">
      <h3 id="logo">BALIBALING</h3>
      <p style="font-size:20px; font-family:oswald;">Soar Above Paradise</p>
    </div>
    <div class="col">
      <h5>Office</h5>
      <strong><p>President University Heliport</p></strong>
      <p>Jl. Melasti, Ungasan, Kec. Kuta Selatan, Kabupaten Badung, Bali 80361</p>
    </div>
    <div class="col">
      <h5>Contacts</h5>
      <table>
        <tr> 
          <td><img src="img/phone.png" style="width:20px;height:20px;"></td>
          <td colspan="5">+62-895-3302-4619</td>
        </tr>
        <tr>
          <td><img src="img/message.png" style="width:20px;height:20px;"></td>
          <td colspan="5">book@balibaling.com</td>
        </tr>
        <tr style="margin-top:2px;">
          <td><img src="img/fb.png" style="width:20px;height:20px;">
          <td><img src="img/ig.png" style="width:18px;height:18px;">
          <td><img src="img/tw.png" style="width:20px;height:20px;">
          <td><img src="img/wa.png" style="width:20px;height:20px;">
          <td><img src="img/yt.png" style="width:20px;height:20px;">
          <td><img src="img/tiktok.png" style="width:17px;height:17px;">
      </table>
    </div>
    <div class="col">
      <h5>About Us</h5>
      <p>This website is Group 6 assignment page, with the team members are Joy Adelia Sihombing, Zafyra R. Azhari, and Zelika Hannah.</p>
    </div>
</footer>
    
</body>
</html>