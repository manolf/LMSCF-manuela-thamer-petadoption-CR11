<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['superadmin']);
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
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Title Page-->
    <title>Superadmin Page</title>



</head>

<body>

    <nav class="navbar sticky-top navbar-dark bg-dark">
        <div>
            <p class="text-white"> Hi <?php echo $userRow['userName']; ?> !</p>
        </div>

        <div class="mx-auto">
            <a class="btn btn-outline-success" href="superadmin.php" role="button">Home</a>
            <a class="btn btn-outline-warning" href="adoptionlist.php" role="button">See Adoptionlist</a>
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
            <h1>Super-Admin Panel</h1>
        </div>
    </div>
    <!-- ADMIN PANEL end  -->




    <!-- SECTION ADD USER  LATER -->

    <!-- <div class="container"> -->

    <!-- try later when its time -->
       <!-- <h4 class="text-success">Add New User</h4>

        <div class="form-group row justify-content-center">

            <form id="submit">
                

                <input type="text" placeholder="userName" name="userName">


                <input type="text" placeholder="Email" name="userEmail">

                <input type="text" placeholder="Imagepath" name="image">

        
                <input type="text" placeholder="status" name="status">

       
                <input type="text" placeholder="Password (provisional)" name="password">

                <input type="submit" class="btn btn-success">
            </form>
        </div> -->
    <!-- </div> -->

 <!-- END SECTION ADD USER -->

    <!-- <?php


            // $sql = "SELECT * FROM users";
            // $res = $conn->query($sql);
            ?> -->

<h4 class="text-success">Edit User</h4>
<p>Information for User Deletes: Note that you can't delete users who are right now in the adoption process and therefore are linked to various tables. You can still delete other users and admins, superadmins though ;-) </p>
<!-- READ BY AJAX  -->
<div class="container">

<div class="form-group row justify-content-center" id="read"> 

</div>

</div>

<!-- END READ AJAX -->

  
    <hr>

    <!--AJAX--->
    <script>
        //** ** ** */ Get info from Read into Home section through Function
        function readInfo() {
            var request;
            request = $.ajax({
                url: "read.php", // * refers now to to the action page method
                type: "post" // * rferes to the usual method named post
                // *! holds key and value
            });

            // Callback handler that will be called on success
            request.done(function(response, textStatus, jqXHR) {
                // Log a message to the console
                document.getElementById("read").innerHTML = response;
                //document.getElementById("result").innerHTML =response;
            });
        }

        // Variable to hold request
        var request;
        readInfo();
        // Bind to the submit event of our form // *>identification id of form = trigger event
        $("#submit").submit(function(event) {

            // Prevent default posting of form - put here to work in case of errors
            event.preventDefault();

            // Abort any pending request
            if (request) {
                request.abort();
            }
            // setup some local variables
            var $form = $(this); // * refferes to the id used = submit

            console.log($form); //just for testing

            // Let's select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea"); // *all tags covered - adjustable

            // Serialize the data in the form
            var serializedData = $form.serialize(); // * selects elements refers to $_POST method

            // Let's disable the inputs for the duration of the Ajax request.
            // Note: we disable elements AFTER the form data has been serialized.
            // Disabled form elements will not be serialized.
            $inputs.prop("disabled", true);

            // Fire off the request to /form.php
            request = $.ajax({
                url: "addUser.php", // * refers to the usual action method
                type: "post", // * rferes to the usual method named post
                data: serializedData // * holds key and value
            });

            // Callback handler that will be called on success
            request.done(function(response, textStatus, jqXHR) {
                // Log a message to the console
                console.log("Success! User added!");
                console.log(response); // double check that
                readInfo();
                //document.getElementById("result").innerHTML =response;
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
        });
    </script>


</body>

</html>