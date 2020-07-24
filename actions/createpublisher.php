<?php 

require_once 'db_connect.php';

if ($_POST) {
   $publisher = $_POST['publisherName'];
   $size = $_POST['size'];
   $addressID = $_POST['addressID'];


   $sql = "INSERT INTO publisher (name, size, addressID) VALUES ($publisher', $size', '$addressID')";
    if($connect->query($sql) === TRUE) {
       echo "<p>New Publisher Successfully Created</p>" ;
       echo "<a href='../create.php'><button type='button'>Back</button></a>";
        echo "<a href='../index.php'><button type='button'>Home</button></a>";
   } else  {
       echo "Error " . $sql . ' ' . $connect->connect_error;
   }

   $connect->close();
}

?>
