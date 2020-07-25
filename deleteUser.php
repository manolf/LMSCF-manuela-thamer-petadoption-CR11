<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['superadmin']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);



if (isset($_GET["id"])){
    $userID = $_GET["id"];

    echo $sql = "DELETE FROM users WHERE userId = $userID" ;
    if($conn->query($sql) === TRUE)
    {
        echo "<center><h3 class='text-success'>User Record Successfully Deleted </h3><center>";
        header("refresh:1 url=superadmin.php");
    } else {
        echo "error while deleting";
    }

}

$conn->close();

?>