<?php
session_start();
require_once('header.php');
require_once('config.php');
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
  $statement->bindValue(':email', $email);
  $statement->execute();
  $user = $statement->fetch(PDO::FETCH_ASSOC);
  if ($user) {
    if ($user['password'] === $password) {
      $status = "Active now";
      $statement = $pdo->prepare("UPDATE users SET status = '{$status}' WHERE unique_id = {$user['unique_id']}");
      $statement->execute();
      $_SESSION['unique_id'] = $user['unique_id'];

      header("location: users.php");
    } else {
      $error = 'Email and Password Combination are Incorrect';
    }
  } else {
    $error = 'Email are Incorrect';
  }
}
?>

<body>
  <div class="wrapper">
    <section class="form login">
      <header>Realtime Chat App</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <?php if ($error) : ?>
          <?php
          echo "<div class=\"error-text\">$error</div>";
          ?>
        <?php endif; ?>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" class="pwd" required>
          <i class="fas fa-eye" id="show-icon"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
  </div>

  <script src="../../My apps/Chat app/javascript/script.js"></script>
  <!-- <script src="javascript/login.js"></script> -->

</body>

</html>