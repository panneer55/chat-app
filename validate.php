<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$image = $_FILES['image'];
if (!$fname) {
    $errors[] = "First Name is Required";
}
if (!$lname) {
    $errors[] = "Last Name is Required";
}
if (!$email) {
    $errors[] = "Email is Required";
}
// elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     $errors[] = "Enter a Valid Email";
// }

if (!$password) {
    $errors[] = "Password is Required";
}
if (!$image['name']) {
    $errors[] = "Please Select an Image";
}
if (!is_dir('profile_img')) {
    mkdir('profile_img');
}
