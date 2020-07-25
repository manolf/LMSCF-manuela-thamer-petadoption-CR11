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
    header("refresh:1; url=login.php");
    //header("Location: login.php");
    exit;
}
// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

//just for checking
// $_SESSION["user"] . " -- " . $_GET["id"];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css"> -->
    <title>Adopt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar sticky-top navbar-dark bg-dark">
        <div>
            <p class="text-white"> Hi <?php echo $userRow['userName']; ?> !</p>
        </div>

        <div class="mx-auto">
            <a class="btn btn-outline-success" href="home.php" role="button">Home</a>
            <a class="btn btn-outline-success" href="logout.php?logout" role="button">Logout</a>



        </div>

        <div class="mr-3 text-white">
            <?php echo $userRow['userEmail']; ?>
        </div>
        <div class="image">
            <img class="icon" src="img/icon/<?php echo $userRow['foto']; ?>" />
        </div>
    </nav>


    <hr> <br>

    <?php
    if ($_GET['id']) {

        $animalID = $_GET["id"];
        $userId = $_SESSION["user"];


        $sql = "INSERT INTO booking (animalID, userID) VALUES ($animalID, $userId)";

        $sql2 = "UPDATE animals SET `status` = 'adopted' WHERE animalID = $animalID";

        if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
            echo "<center><h3 class='text-success'>Congratulations!</h3></center>";

            echo "<center>Your pet is looking forward to meeting you soon!</center>";

            header ("refresh:2; url=home.php" ); 
            echo "<center>You will be redirected in 2 seconds.</center>";
            // echo "<a href='../index.php'><button type='button'>Back</button></a>";


        } else {
            echo "Error " . $sql . ' ' . $conn->conn_error;
            echo "Error " . $sql2 . ' ' . $conn->conn_error;
        }
    }

    ?>


</body>

</html>