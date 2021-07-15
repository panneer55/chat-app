<?php
session_start();
require_once('header.php');
require_once('config.php');
$errors = [];
// $email = $password = $fname = $lname = $image = "";
function random_string($n)
{
  $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';
  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($chars) - 1);
    $str .= $chars[$index];
  }
  return $str;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once('validate.php');
  if (empty($errors)) {
    if ($image && $image['tmp_name']) {
      $imagePath = 'profile_img/' . random_string(8) . '/' . $image['name'];
      mkdir(dirname($imagePath));
      move_uploaded_file($image['tmp_name'], $imagePath);
    }

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindValue(':email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
      $unique_id = rand(time(), 100000000);
      $status = "Active now";

      // echo "insert into value";

      $statement = $pdo->prepare("INSERT INTO users (unique_id,fname, lname, email, password, img, status)  VALUES (:unique_id, :fname, :lname, :email, :password, :image, :status)");
      $statement->bindValue(":unique_id", $unique_id);
      $statement->bindValue(":fname", $fname);
      $statement->bindValue(":lname", $lname);
      $statement->bindValue(":email", $email);
      $statement->bindValue(":password", $password);
      $statement->bindValue(":image", $imagePath);
      $statement->bindValue(":status", $status);
      $statement->execute();
      $_SESSION['unique_id'] = $unique_id;
      header("location: users.php");
    } else {

      $errors[] =  "This email already Exist- try another";
    }
  }
}

?>


<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Realtime Chat App</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <?php if (!empty($errors)) : ?>
          <div class="error-text">
            <?php foreach ($errors as $error) : ?>
              <?php echo $error . '<br>' ?>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name">
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name">
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email">
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" class="pwd">
          <i class="fas fa-eye" id="show-icon"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
        </div>
        <div class=" field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <script src="../../My apps/Chat app/javascript/script.js"></script>
  <!-- <script src="javascript/signup.js"></script> -->

</body>

</html>