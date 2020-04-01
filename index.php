<?php
require 'server/functions.php';
$connection = dbConnect();

$data = array(
  "loggedIn"=> false,
  "error"=> false
);

try {
  // Get all posts
  $posts = $connection->query("SELECT * FROM uploads ORDER BY id DESC");

  // Session Check
  session_start();
  if (isset($_SESSION['user_id'])) {
    $data["loggedIn"] = true;
  }

} catch(PDOException $e) {
  $data["error"] = true;
}

?>

<!DOCTYPE html>
<html lang="nl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Justin Rodriguez Montoya, Mike Yang">
    <meta name="keywords" content="feed, fashion, kleding, streetware, jongvolwassen, broek, trui, verhaal, sociaal">
    <meta name="description" content="">

    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="shortcut icon" href="img/logo.png">
    <title>FashaHolic | Feed</title>

    <script src="https://kit.fontawesome.com/7023acb312.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="bg"></div>

    <nav class="desktop">
      <?php
      if ($data["loggedIn"]) {
        if (file_exists('profilepictures/' . $_SESSION['username'])) {
          ?><img src="profilepictures/<?php $_SESSION['username']; ?>" alt="profilepicture" class="myProfilePicture"><?php
        }
        else {
          ?><img src="img/defaultuser.jpg" alt="profilepicture" class="myProfilePicture"><?php
        }
        ?><h3 class="myUsername"> <?php echo ucfirst($_SESSION['username']); ?></h3><?php
      }

      ?>
      <a href="index.php"><span class="fas fa-home"></span> Feed</a>
      <a href="#"><span class="fas fa-bookmark"></span> Bookmarks</a>
      <a href="#"><span class="fas fa-user-edit"></span> Profiel Instellingen</a>
      <?php

      if ($data["loggedIn"]) {
        ?><a href="logout.php"><span class="fas fa-sign-in-alt"></span> Uitloggen</a><?php
      }
      else {
        ?><a href="login.php"><span class="fas fa-sign-in-alt"></span> Inloggen</a><?php
      }
      ?>
    </nav>

    <nav class="mobile">

    </nav>

    <div class="feed">

      <div class="top" id="top">
        <h2><span class="fas fa-comments"></span> Feed</h2>
      </div>

      <?php
      if ($data["loggedIn"]) {
        ?>
        <form class="messageBox" action="post.php" method="POST">
          <input type="title" name="title" value="" placeholder="Titel" class="title" autocomplete="off" required>
          <textarea name="message" rows="8" cols="80" placeholder="Deel een bericht" required></textarea>
          <div class="functions">
            <input type="file" id="real-file" hidden="hidden" enctype="multipart/form-data" accept="image/*">
            <button type="button" id="custom-button">Foto toevoegen</button>
            <input type="submit" name="submit" value="Plaatsen" class="post">
          </div>
        </form>
        <?php
      }

      ?>
      <div class="posts">
        <?php
        foreach ($posts as $key => $row) {
          ?>
          <section>
            <div class="icons">
              <h5 class="fas fa-heart like"> <span><?php echo $row["likes"] ?></span></h5>
              <h5 class="fas fa-bookmark save"> <span></span></h5>
            </div>

            <?php
              ?><img src="img/defaultuser.jpg" alt="profilepicture" class="profilePicture"><?php
            ?>

            <h2><?php echo $row["author_name"] . "<br>"?><span><?php echo $row["date"]; ?></span></h2>

            <?php

            if (!$row['image'] == NULL) {
              ?> <img src="postimages/<?php echo $row["image"] ?>" alt="<?php echo $row["author_name"] ?>" class="postImg"> <?php
            } ?>

            <h3><?php echo $row["title"] ?></h3>
            <p><?php echo $row["caption"] ?></p>
          </section>
          <?php
        }
        ?>
      </div>

      <h3 class="end">Dat was alles!</h3>
      <a href="#top" class="fas fa-angle-double-up"></a>

    </div>

    <?php
    if ($data["loggedIn"]) {
      ?><script src="js/upload.js"></script><?php
    }
    ?>
  </body>
</html>
