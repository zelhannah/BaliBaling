<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>footer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

  <style>
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

    ul {
      display: flex;
      margin-top: 15px;
      margin-left: 300px;
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


    </style>
</head>
<body>
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
          <td><img src="phone.png" style="width:20px;height:20px;"></td>
          <td colspan="5">+62-895-3302-4619</td>
        </tr>
        <tr>
          <td><img src="message.png" style="width:20px;height:20px;"></td>
          <td colspan="5">book@balibaling.com</td>
        </tr>
        <tr style="margin-top:2px;">
          <td><img src="fb.png" style="width:20px;height:20px;">
          <td><img src="ig.png" style="width:18px;height:18px;">
          <td><img src="tw.png" style="width:20px;height:20px;">
          <td><img src="wa.png" style="width:20px;height:20px;">
          <td><img src="yt.png" style="width:20px;height:20px;">
          <td><img src="tiktok.png" style="width:17px;height:17px;">
      </table>
    </div>
    <div class="col">
      <h5>About Us</h5>
      <p>This website is Group 6 assignment page, with the team members are Joy Adelia Sihombing, Zafyra R. Azhari, and Zelika Hannah.</p>
    </div>
</footer>
    
</body>
</html>