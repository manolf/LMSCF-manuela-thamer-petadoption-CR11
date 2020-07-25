<?php require_once 'actions/db_connect.php'; ?>
<!-- for users without login -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Pet Adoption</title>
</head>

<body>

    <!-- bootstrap version -->
    <nav class="navbar sticky-top navbar-dark bg-dark">

        <div class="mx-auto">
            <a class="btn btn-outline-success" href="index.php" role="button">Home</a>
            <a class="btn btn-outline-success" href="login.php" role="button">Login</a>
            <a class="btn btn-outline-success" href="register.php" role="button">Signup</a>
        </div>
    </nav>

    <div class="jumbotron jumbotron-fluid bg-dark text-white">
        <div class="container">
            <h1 class="display-4 text-success">Adopt a pet</h1>
            <p class="lead">Sign up to meet your new buddy..</p>
        </div>
    </div>

<div class="mx-left">
    <a class="btn btn-outline-success" href="index.php" role="button">All</a>
    <a class="btn btn-outline-success" href="general2.php" role="button">Small and Big Animals</a>
    <a class="btn btn-outline-success" href="senior2.php" role="button">Senior Animals</a>
</div>

    <!-- <div class="container autos row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto"> -->
    <div class="container row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto">

        <?php
        $sql = "SELECT * FROM animals
        INNER JOIN address on address.addressID = animals.addressID
        where animals.type in ('large','small');
        ";

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
            $typ = $row['typ'];
            $animalID = $row['animalID'];
            $status = $row['status'];

        ?>

            <div class="col mb-3 ">
                <div class="card px-1 py-1 bg-light">
                    <h5 class="card-title text-secondary"><?= $status ?></h5>
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
                        <!-- <a href="delete.php?book_id=<?= $animalID ?>" class="btn btn-outline-danger  mx-auto">Delete medium</a>
                <a href="update.php?book_id=<?= $animalID ?>" class="btn btn-outline-success mx-auto">Update medium</a> -->
                        <a href="adopt.php?book_id=<?= $animalID ?>" class="btn btn-outline-success mx-auto">Meet <?= $name ?> </a>
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