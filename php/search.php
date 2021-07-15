<?php
session_start();
require_once('../config.php');
$outgoing_id = $_SESSION['unique_id'];
$output = '';


$searchTerm = $_POST['searchTerm'];
$statement = $pdo->prepare("SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND fname like '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%'");
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
if (empty($users)) {
  $output .= "No Users is found to your related search";
} else {
  require_once("data.php");
}
echo $output;
