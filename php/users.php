<?php
session_start();
require_once('../config.php');
$output = '';
$outgoing_id = $_SESSION['unique_id'];
$statement = $pdo->prepare("SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}");
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
if (empty($users)) {
  $output .= "No Users is available";
} else {
  require_once("data.php");
}
echo $output;
