<?php
ob_start();
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
   header("Location: index.php");
   exit;
}
if (isset($_SESSION["user"])) {
   header("Location: home.php");
   exit;
}
// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['admin']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);


if ($_POST) {
   $animalID = $_POST['animalID'];

   $sql = "DELETE FROM animals WHERE animalID = $animalID";

?>

   <!DOCTYPE html>
   <html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../style1.css">
      <title>Delete Card</title>
   </head>

   <body>
   <nav class="navbar sticky-top navbar-dark bg-dark">
         <div>
            <p class="text-white"> Hi <?php echo $userRow['userName']; ?> !</p>
         </div>

         <div class="mx-auto">
            <a class="btn btn-outline-success" href="admin.php" role="button">Home</a>
            <a class="btn btn-outline-warning" href="create.php" role="button">Add Animal</a>
            <a class="btn btn-outline-success" href="logout.php?logout" role="button">Logout</a>
         </div>

         <div class="mr-3 text-white">
            <?php echo $userRow['userEmail']; ?>
         </div>
         <div class="image">
            <img class="icon" src="../img/icon/<?php echo $userRow['foto']; ?>" />
         </div>
      </nav>


   <?php

   if ($conn->query($sql) === TRUE) {
      echo "<div class='text-center'>";
      echo "<p><b>Successfully deleted!!</b></p>";
      header("refresh:2; url=../admin.php");
      echo "You will be redirected in 2 seconds.<br>";
      echo "<a href='../admin.php'><button type='button'>Back</button></a>";
      echo "</div>";
   } else {
      echo "Error updating record : " . $conn->error;
   }

   $conn->close();
}

   ?>

   </body>

   </html>