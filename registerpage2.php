<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Account Creation</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      padding: 30px;
      box-sizing: border-box;
      background: url('img/heli4.jpg');
      background-size: cover;
    }

    .container {
      max-width: 450px;
      margin: 0 auto;
      padding: 20px 40px 20px 40px;
      border: 2px solid black;
      border-radius: 15px;
      background: white;

    }

    /* .container .input-box input::placeholder {
      color: black;
    } */

    .container h1 {
      text-align: center;
      padding-bottom: 10px;
    }

    .container form > div {
      margin-bottom: 10px;
    }

    .container form label {
      display: block;
      margin-bottom: 10px;
    }

    .container form input[type="text"],
    .container form input[type="Password"],
    .container form input[type="EmailName"],
    .container form input[type="number"],
    .container form select {
      display: block;
      margin: 0 auto;
      width: 400px;
      padding: 10px 20px 10px 20px; 
      font-size: 16px;
      border-radius: 40px;
      border: 2px solid black;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    
    .container form select {
      width: 450px;
    }

    .container form button {
      width: 100%;
      padding: 10px 15px;
      margin-top:20px;
      font-size: 16px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .input-box.active input {
      border-color: #1e00ff; 
      box-shadow: 0 0 10px #1e00ff;
    }
        
    .PasswordMatch {
     color: red;
     display: none; 
     margin-top: 10px;
     font-size: 15px;
    }

    #result {
      margin-top: 20px;
    }

    #result p {
      margin-bottom: 5px;
    }

    #result span {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Create Customer Account</h1>
    <form id="registrationForm">
      <div class="input-box">
        <label for="FirstName">First Name:</label>
        <input type="text" id="FirstName" required>
      </div>
      <div class="input-box">
        <label for="LastName">Last Name:</label>
        <input type="text" id="LastName" required>
      </div>
      <div class="input-box">
        <label for="EmailName">Email Name:</label>
        <input type="EmailName" id="EmailName" required>
      </div>
      <div class="input-box">
        <label for="Phone">Phone Number:</label>
        <input type="number" id="Phone" required>
      </div>
      <div class="input-box">
        <label for="Username">Username:</label>
        <input type="text" id="Username" pattern="^(?=.*[a-zA-Z0-9]){4,}$" title="Minimum 4 characters, alphanumeric only" required>
      </div>
      <div class="input-box">
        <label for="Password">Login Password:</label>
        <input type="Password" id="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$" title="Password must contain at least one lowercase letter, one uppercase letter, one number, and be 8 characters long" required>
      </div>
      <div class="input-box">
        <label for="confirmPassword">Password confirmation:</label>
        <input type="Password" id="confirmPassword" required>
        <span id="PasswordMatch" class="PasswordMatch">Password and Confirm Password do not match!</span>
      </div>
      <div>
        <button type="submit">Create Account</button>
      </div>
    </form>
    <div id="result" style="display: none;">
      <h2>Registration Successful!</h2>
      <p>First Name: <span id="resultFirstName"></span></p>
      <p>Last Name: <span id="resultLastName"></span></p>
      <p>Email Name: <span id="resultEmailName"></span></p>
      <p>Phone Number: <span id="resultPhone"></span></p>
      <p>Username: <span id="resultUsername"></span></p>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $('.input-box input').focus(function () {
        $(this).parent().addClass('active');
      });

      $('.input-box input').blur(function () {
        if ($(this).val() === '') {
          $(this).parent().removeClass('active');
        }   
      });
    });

    document.getElementById("registrationForm").addEventListener("submit", function(event) {
      event.preventDefault();
      
      var FirstName = document.getElementById("FirstName").value;
      var LastName = document.getElementById("LastName").value;
      var EmailName = document.getElementById("EmailName").value;
      var Phone = document.getElementById("Phone").value;
      var Username = document.getElementById("Username").value;
      var Password = document.getElementById("Password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      
      if (Password !== confirmPassword) {
        document.getElementById("PasswordMatch").style.display = "block";
        return;
      } else {
        document.getElementById("PasswordMatch").style.display = "none";
      }
      
      // Display result
      document.getElementById("resultFirstName").textContent = FirstName;
      document.getElementById("resultLastName").textContent = LastName;
      document.getElementById("resultEmailName").textContent = EmailName;
      document.getElementById("resultPhone").textContent = Phone;
      document.getElementById("resultUsername").textContent = Username;
      document.getElementById("result").style.display = "block";

      // Redirect ke halaman beranda setelah 2 detik
      setTimeout(function(){
          window.location.href = "homepage2.php"; // Ganti dengan URL halaman beranda Anda
      }, 2000); // Waktu delay dalam milidetik (2000ms = 2 detik)

          });
  </script>
</body>
</html>
