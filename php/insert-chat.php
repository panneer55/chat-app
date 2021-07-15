<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    require_once("../config.php");

    $outgoing_id = $_SESSION["unique_id"];
    $incoming_id =  $_POST['incoming_id'];
    $msg =  $_POST['message'];

    $statement = $pdo->prepare("INSERT INTO messages (incoming_id, outgoing_id, message)
    VALUES (:incoming_id, :outgoing_id, :msg) ");
    $statement->bindValue(":outgoing_id", $outgoing_id);
    $statement->bindValue(":incoming_id", $incoming_id);
    $statement->bindValue(":msg", $msg);
    $statement->execute();
} else {

    header("location: ../login.php");
}
