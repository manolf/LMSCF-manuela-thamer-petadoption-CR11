<?php
ob_start();
session_start();

require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>


<?php

if (isset($_GET['id'])) {
    $userID = $_GET['id'];

    $sql = "SELECT * FROM users WHERE userId = $userID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hey Welcome - <?= $userRow['userName']; ?></title>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        <?php include 'style.css'; ?>
    </style>
</head>

<body>
<h3>Update Employee</h3>
    <div class="container">

        <div class="row justify-content-center">
            <form action="actions/a_updateUser.php" method="post">

            <form id="submit">
                <!-- action="addmore.php" method="post"  //not needed with AJAX--->

                <label>User Name</label>
                <input type="text" value="<?= $row['userName'] ?>" name="userName">

                <label>User Email</label>
                <input type="text" value="<?= $row['userEmail'] ?>" name="userEmail">

                <label>Image Path</label>
                <input type="text" value="<?= $row['image'] ?>" name="image">

                <label>status</label>
                <input type="text" value="<?= $row['status'] ?>" name="status">

                <label>provisional password</label>
                <input type="text" value="<?= $row['userPass'] ?>" name="password">

                <input type="hidden" name="userId" value="<?= $row['userId'] ?>">

                <input type="submit" class="btn btn-success">
            </form>

        </div>
    </div>

</body>
</html>

