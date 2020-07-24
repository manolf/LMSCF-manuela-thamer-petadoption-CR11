<?php 

require_once 'db_connect.php';

if ($_POST) {
   $firstname = $_POST['firstname'];
   $surname = $_POST['surname'];

   $sql = "INSERT INTO author (firstname, surname) VALUES ('$firstname', '$surname')";
    if($connect->query($sql) === TRUE) {
       echo "<p>New Author Successfully Created</p>" ;
       echo "<a href='../create.php'><button type='button'>Back</button></a>";
        echo "<a href='../index.php'><button type='button'>Home</button></a>";
   } else  {
       echo "Error " . $sql . ' ' . $connect->connect_error;
   }

   $connect->close();
}

?>