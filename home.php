<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if (isset($_SESSION["superadmin"])) {
    header("Location: superadmin.php");
    exit;
}
if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Welcome - <?php echo $userRow['userEmail']; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

    <nav class="navbar sticky-top navbar-dark bg-dark">
        <div>
            <p class="text-white"> Hi <?php echo $userRow['userName']; ?> !</p>
        </div>

        <div class="mx-auto">
            <a class="btn btn-outline-success" href="index.php" role="button">Home</a>
            <a class="btn btn-outline-success" href="logout.php?logout" role="button">Logout</a>
        </div>

        <div class="mr-3 text-white">
            <?php echo $userRow['userEmail']; ?>
        </div>
        <div class="image">
            <img class="icon" src="img/icon/<?php echo $userRow['foto']; ?>" />
        </div>
    </nav>

    <div class="jumbotron jumbotron-fluid bg-dark text-white">
        <div class="container">
            <h1 class="display-4 text-success">Adopt a pet</h1>
            <p class="lead">Your new buddy is just a click far away from you..</p>
        </div>
    </div>

    <nav class="navbar navbar-dark bg-white">

        <div class="mx-left">
            <a class="btn btn-outline-success" href="home.php" role="button">All</a>
            <a class="btn btn-outline-success" href="general.php" role="button">Small and Big Animals</a>
            <a class="btn btn-outline-success" href="senior.php" role="button">Senior Animals</a>
        </div>

        <div>
            <form>
                <p class="text-success">SEARCH</p>
                <input type="text" name="search" id="search">
            </form>

            <p id="result"></p>
        </div>
    </nav>

    <!-- <div class="container autos row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto"> -->
    <div class="container row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto">

        <?php
        $sql = "SELECT * FROM animals
INNER JOIN address on address.addressID = animals.addressID
        WHERE `status`= 'available'";

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
                        <a href="adopt.php?id=<?= $animalID ?>" class="btn btn-outline-success mx-auto">Meet <?= $name ?> </a>
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
            // Let's disable the inputs for the duration of the Ajax request.
            // Note: we disable elements AFTER the form data has been serialized.
            // Disabled form elements will not be serialized.

        });
    </script>

</body>

</html>