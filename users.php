<?php
session_start();
require_once('header.php');
require_once("config.php");
if (!$_SESSION['unique_id']) {
  header("location: index.php");
}
$id = $_SESSION['unique_id'];

$statement = $pdo->prepare("SELECT * FROM users WHERE unique_id = :id");

$statement->bindValue(':id', $id);
$statement->execute();
$users = $statement->fetch(PDO::FETCH_ASSOC);

?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <img src="<?php
                    echo $users['img'];

                    ?>" alt="">
          <div class="details">
            <span><?php
                  echo $users['fname'] . ' ' . $users['lname'];
                  ?></span>
            <p><?php
                echo $users['status'];
                ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id= <?php echo $users['unique_id'] ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list" id="users-list">

      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>

</html>