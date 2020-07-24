<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['user'])) {
    echo "<script>alert('You need to login to adopt an animal');</script>"; //ALERT
    //echo "<script> swal('Oops...Invalid credentials!', 'error')</script>";
    //echo "You need to login to adopt an animal<br>"; //ECHO
    echo "you will be redirected to the login-page";
    header ("refresh:2; url=login.php" ); 
    //header("Location: login.php");
    exit;
}
// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

//just for checking
echo $_SESSION["user"] . " -- " . $_GET["id"];

if ($_GET['id']) {

    $animalID = $_GET["id"];
    $userId = $_SESSION["user"];

    //  INSERT INTO `booking` (`bookingID`, `animalId`, `userId`) VALUES (NULL, '2', '3');
    echo   $sql = "INSERT INTO booking (animalID, userID) VALUES ($animalID, $userId)";

    echo    $sql2 = "UPDATE animals SET `status` = 'adopted' WHERE animalID = $animalID";

    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        echo "Booking success <br> <a href='home.php'>Back to Home</a><br>";
        echo "Congratulations! Your pet is looking forward to meet you soon!";
    } else {
        echo "Error " . $sql . ' ' . $conn->conn_error;
        echo "Error " . $sql2 . ' ' . $conn->conn_error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>Adopt</title>
</head>

<body>
<nav class="navbar sticky-top navbar-dark bg-dark">

<div class="mx-auto">
    <a class="btn btn-outline-success" href="index.php" role="button">Home</a>
    <a class="btn btn-outline-success" href="login.php" role="button">Login</a>
    <a class="btn btn-outline-success" href="register.php" role="button">Signup</a>
</div>
</nav>

</body>

</html>