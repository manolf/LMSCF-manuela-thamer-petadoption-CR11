<?php 

require_once 'db_connect.php';

echo "a_updateUser.php";

if(isset($_POST['submit'])){
 echo   $id = $_POST['id'];

  echo  $userName = $_POST['userName'];
 echo   $status = $_POST['status'];

    $sql = "UPDATE user SET userName='$userName', 'status' ='$status' WHERE userId= $id ";

    if($conn->query($sql) === TRUE)
    {
        echo "<center><h3>succesfuly updated </h3></center>";
        header("refresh:1 url=home.php");
    } else {
        echo "error ";
    }
}

$conn->close();

?>

