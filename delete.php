<?php 
ob_start();
session_start();
require_once 'actions/db_connect.php';

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



if ($_GET['id']) {
   $animalID = $_GET['id'];

   $sql = "SELECT * FROM animals WHERE animalID = $animalID" ;
   $result = $conn->query($sql);
   $data = $result->fetch_assoc();

   $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
   <title >Delete </title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> 
</head>
<body>
<nav class="navbar sticky-top navbar-light bg-light">
        
        <div class= "mx-auto">
                <a class="btn btn-outline-success" href="index.php" role="button">Home</a>
                <a class="btn btn-outline-success" href="create.php" role="button">Add Medium</a>
                <a class="btn btn-outline-success" href="create.php" role="button">Add Author</a>
                <a class="btn btn-outline-success" href="create.php" role="button">Add Publisher</a>
        </div>
        </nav>

<h3>Do you really want to delete this card?</h3>
<form action ="actions/a_delete.php" method="post">

   <input type="hidden" name= "animalID" value="<?php echo $data['animalID'] ?>" />
   <button type="submit">Yes, delete it!</button >
   <a href="admin.php"><button type="button">No, go back!</button ></a>
</form>

</body>
</html>

<?php
}
?>