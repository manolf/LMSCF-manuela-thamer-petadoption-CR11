<?php 

ob_start();
session_start();

require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
//$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);



    $sql = "SELECT * FROM `animals`
    inner join booking on booking.animalId = animals.animalID
    inner join users on users.userId = booking.bookingID";
    $res = $conn->query($sql);
?>

<table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name of the Animal</th>
                        <th>Photo</th>
                        <th>adopted by</th>
                        <th>Mail</th>
                    </tr>
                </thead>
                <?php
                while ($row = $res->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['bookingID']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><img class="icon" src="img/<?= $row['image']; ?>"></td>
                        <td><?= $row['userName']; ?></td>
                        <td><?= $row['userEmail']; ?></td>
                        <td>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>

            