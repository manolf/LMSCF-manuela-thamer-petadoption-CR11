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



    $sql = "SELECT * FROM users";
    $res = $conn->query($sql);
?>

<table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>status</th>
                    </tr>
                </thead>
                <?php
                while ($row = $res->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['userId']; ?></td>
                        <td><?= $row['userName']; ?></td>
                        <td><?= $row['userEmail']; ?></td>
                        <td><?= $row['foto']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td>
                            <!-- later update when time -->
                            <!-- <a href="updateUser.php?id=<?= $row['userId']; ?>" class="btn btn-info" name="update">Update</a> -->

                            <a href="deleteUser.php?id=<?= $row['userId']; ?>" class="btn btn-outline-danger" name="delete">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>