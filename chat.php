<?php
require_once('header.php');
require_once('config.php');
session_start();
if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}
$id = $_SESSION['unique_id'];
$user_id = $_GET['user_id'];

$statement = $pdo->prepare("SELECT * FROM users WHERE unique_id = :id");

$statement->bindValue(':id', $user_id);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);
?>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $user['img'] ?>" alt="">
        <div class="details">
          <span><?php echo $user['fname'] ?></span>
          <p><?php echo $user['status'] ?></p>
        </div>
      </header>
      <div class="chat-box">
        <?php
        // echo $user_id;
        // echo $_SESSION['unique_id'];

        ?>
      </div>
      <form action="#" method="POST" class="typing-area">
        <input type="text" class="outgoing_id" name="outgoing_id" hidden value="<?php echo $_SESSION['unique_id'] ?>">

        <input type="text" class="incoming_id" name="incoming_id" hidden value="<?php echo $user_id ?>">

        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>

</html>