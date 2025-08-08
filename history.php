<?php
include_once("config.php");
$UserID = $_GET['UserID'];

$query = "SELECT b.*, p.PaymentID, t.TripName, t.Duration, p.FinalAmount, p.PaymentStatus 
FROM booking b INNER JOIN trips t ON b.TripID = t.TripID
INNER JOIN payment p ON b.BookingID = p.BookingID
WHERE p.PaymentStatus = 'SUCCESS' AND b.UserID = (SELECT UserID FROM user WHERE UserID = $UserID)
GROUP BY b.BookingID;";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <style>
        body {
            background-image: url('img/sce3.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0; 
            overflow-x: hidden; 
        }

        .container {
            background-color: rgba(255, 255, 255, 0.7); 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); 
            max-width: 90%; 
            width: 100%; 
            text-align: center; 
            overflow-x: auto; 
            margin-top: -100px;
        }

        table {
            width: 100%; 
            border-collapse: collapse;
            font-size: 16px; 
        }

        th, td {
            padding: 5px; 
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-size: 18px; 
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2; 
        }

        .back-button {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Booking History</h1>
        <table>
            <thead>
            <tr>
                <th>Booking ID</th>
                <th>User ID</th>
                <th>Payment ID</th>
                <th>Trip Date</th>
                <th>Trip Name</th>
                <th>Duration</th>
                <th>Passengers</th>
                <th>Cost</th>
                <th>Booking Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['BookingID']; ?></td>
                    <td><?php echo $row['UserID']; ?></td>
                    <td><?php echo $row['PaymentID']; ?></td>
                    <td><?php echo $row['TripDate']; ?></td>
                    <td><?php echo $row['TripName']; ?></td>
                    <td><?php echo $row['Duration']; ?></td>
                    <td><?php echo $row['Passengers']; ?></td>
                    <td>IDR <?php echo $row['FinalAmount']; ?></td>
                    <td><?php echo $row['BookingDate']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <button class="back-button" onclick="window.location.href = 'homepagee.php?UserID=<?php echo $UserID; ?>';">Back to Homepage</button>
    </div>
</body>
</html>
