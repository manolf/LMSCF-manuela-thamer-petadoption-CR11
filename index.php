<?php require_once 'actions/db_connect.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Adoption</title>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

    <nav class="navbar navbar-dark bg-white">

<div class="mx-left">
    <a class="btn btn-outline-success" href="index.php" role="button">All</a>
    <a class="btn btn-outline-success" href="general2.php" role="button">Small and Big Animals</a>
    <a class="btn btn-outline-success" href="senior2.php" role="button">Senior Animals</a>
</div>

<div>
            <form>
                <p class="text-success">SEARCH by Name </p>
                <input type="text" name="search" id="search">
            </form>

          
        </div>
</nav>
<p id="result"></p>
  
<!-- <div class="container row col-lg-4 col-md-6 col-xs-12 mx-auto"> -->
<!-- <div class="container row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 mx-auto"> -->
<div class="container row row-cols-md-2 row-cols-sm-2 row-cols-lg-3 row-col-xs-1 mx-auto">
    <!-- <div class="container row row-cols-md-2 row-cols-lg-3 row-cols-xs-1 mx-auto"> -->

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
            $status = $row['status'];

        ?>

            <div class="col">
            <!-- <div class="col mb-3 "> -->
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
                        <!-- <a href="delete.php?book_id=<#?= $animalID ?>" class="btn btn-outline-danger  mx-auto">Delete medium</a>
                <a href="update.php?book_id=<#?= $animalID ?>" class="btn btn-outline-success mx-auto">Update medium</a> -->
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


<script>
        //Search function AJAX
        var request;

        //PART SEARCH
        // Bind to the submit event of our form
        $("#search").keyup(function(event) {

            // Prevent default posting of form - put here to work in case of errors
            event.preventDefault();

            // Abort any pending request
            if (request) {
                request.abort();
            }
            // setup some local variables
            var $form = $(this);

            // Let's select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea");

            // Serialize the data in the form
            var serializedData = $form.serialize();

            // console.log(serializedData);
            var search = document.getElementById("search").value;
            if (search.length > 0) {
                $inputs.prop("disabled", true);

                // Fire off the request to /form.php
                request = $.ajax({
                    url: "search.php",
                    type: "post",
                    data: serializedData
                });

                // Callback handler that will be called on success
                request.done(function(response, textStatus, jqXHR) {
                    // Log a message to the console
                    document.getElementById("result").innerHTML = response;
                    // console.log(response);
                });

                // Callback handler that will be called on failure
                request.fail(function(jqXHR, textStatus, errorThrown) {
                    // Log the error to the console
                    console.error(
                        "The following error occurred: " +
                        textStatus, errorThrown
                    );
                });

                // Callback handler that will be called regardless
                // if the request failed or succeeded
                request.always(function() {
                    // Reenable the inputs
                    $inputs.prop("disabled", false);
                });
            } else {
                document.getElementById("result").innerHTML = "";
            }
            // search => 
            // disable the inputs for the duration of the Ajax request.
            // Note: disable elements AFTER the form data has been serialized.
            // Disabled form elements will not be serialized.

        });
    </script>

    </div>

</body>

</html>