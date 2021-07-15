<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "../config.php";
    $logout_id = $_GET['logout_id'];
    if (isset($logout_id)) {
        $status = "Offline now";
        $statement = $pdo->prepare("UPDATE users SET status = '{$status}' WHERE unique_id = {$logout_id}");

        if ($statement->execute()) {
            echo "sucesss";
            session_unset();
            session_destroy();
            header("location: ../login.php");
        }
    } else {
        header("location: ../users.php");
    }
} else {
    header("location: ../login.php");
}
