<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
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



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- Title Page-->
    <title>Admin Page</title>



</head>

<body>
    
<nav class="navbar sticky-top navbar-dark bg-dark">
        <div><p class="text-white"> Hi <?php echo $userRow['userName']; ?> !</p></div>

        <div class="mx-auto">
            <a class="btn btn-outline-success" href="index.php" role="button">Home</a>
            <a class="btn btn-outline-warning" href="create.php" role="button">Add Animal</a>
            <a class="btn btn-outline-success" href="logout.php?logout" role="button">Logout</a>
        </div>

        <div class="mr-3 text-white">
            <?php echo $userRow['userEmail']; ?>
        </div>
        <div class="image">
            <img class="icon" src="img/icon/<?php echo $userRow['foto']; ?>" />
        </div>
    </nav>


<hr>

<!-- ADMIN PANEL start  -->
<div class="mx-auto">
    <div>
<h1>Admin Panel</h1>
</div>
</div>
<!-- ADMIN PANEL end  -->



<hr>
<div>
<div>
    <h1></h1>
</div>

</div>

    <!-- <div class="container autos row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto"> -->
    <div class="container row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto">

        <?php
        $sql = "SELECT * FROM animals
        INNER JOIN address on address.addressID = animals.addressID";

        //nicer version
        $result = mysqli_query($conn, $sql);
        // fetch the next row (as long as there are any) into $row
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $image = $row['image'];
            $string = $row['description'];
            $location = $row['street'] . ", " . $row['zipcode'] . " " . $row['city'];
            $hobbies = $row['hobbies'];
            $age = $row['age'];
            $type = $row['type'];
            $animalID = $row['animalID'];

        ?>

            <div class="col mb-3 ">
                <div class="card px-1 py-1 bg-light">
                    <h5 class="card-title text-secondary"><?= $type ?></h5>
                    <img src="img/<?= $image ?>" class="card-img-top vh-40">
                    <div class="card-body">
                        <h3 class="card-text text-success font-weight-bold"><?= $name ?> <span></span></h3>
                        <h6 class="card-text"> <?= $string ?> </h6>
                        <h6 class='card-text'><span class='font-weight-bold'>hobbies: </span> <?= $hobbies ?>
                        </h6>
                        <h6 class='card-text'><span class='font-weight-bold'>age: </span> <?= $age ?>
                        </h6>
                        <h7 class="card-text"><span class="font-weight-bold">location:</span> <?= $location ?></h7>

                    </div>
                    <div class="card-footer text-center">
                    <a href="delete.php?id=<?= $animalID ?>" class="btn btn-outline-danger  mx-auto">Delete </a>
                <a href="update.php?id=<?= $animalID ?>" class="btn btn-outline-success mx-auto">Update </a>
                    </div>
                </div>
            </div>

        <?php
        }

        // Free result set
        mysqli_free_result($result);
        // Close connection
        mysqli_close($conn);
        ?>

    </div>


</body>

</html>