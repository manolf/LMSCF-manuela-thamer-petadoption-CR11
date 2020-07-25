<?php 

require_once 'actions/db_connect.php';

echo "addUser.php";


if(isset($_POST['submit'])){
    $id = $_POST['id'];
$userName = $_POST["userName"];
$userEmail = $_POST["userEmail"];
$image = $_POST["image"];
$status = $_POST["status"];
$pass = $_POST['password'];

   // password hashing for security
   $password = hash('sha256', $pass);

$sql = "INSERT INTO users (userName, userEmail, foto, userPass, `status`) VALUES ('$userName', '$userEmail', '$foto', '$password')";

if($conn->query($sql) === TRUE)
{
    echo "<h3>succesfuly updated <h3><br> <a href='superadmin.php'>Back Home</a>";
    header("Refresh:1; url=admin.php");
} else {
    echo "error while adding User";
}


}
/*
if ($_POST){
    $uname = $_POST['userName'];
    $post = $_POST['position'];

    $sql = "INSERT INTO user (userName, position) VALUES ('$uname', '$post')";

    if($connect->query($sql) === TRUE)
    {
        echo "<h3>succesfuly updated <h3><br> <a href='../home.php'>Back Home</a>";
        header("refresh:1 url=home.php");
    } else {
        echo "error dhu check your code again";
    }

}*/

$conn->close();

?>