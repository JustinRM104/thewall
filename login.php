<?php
require 'server/functions.php';
$connection = dbConnect();

$data = array(
  "loggedIn"=> false,
  "error"=> false
);

$formData = array(
  'accountExists' => true,
  'passwordCorrect' => true
);

$username = NULL;
$password = NULL;

try {
  // Get accounts
  $accounts = $connection->query("SELECT * FROM accounts;");

  // Check if sumbitted
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
      $sql = "SELECT * FROM accounts WHERE username = :username";
      $parameters = ['username' => $username];
      $stmt = $connection->prepare($sql);
      $stmt->execute($parameters);

      if ($stmt->rowCount() === 1 ) {
        $user = $stmt->fetch();

        if (password_verify($password, $user['password'])) {

          session_start();
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['username'] = $user['username'];

          header("Location: index.php");
          exit;
        }
        else {
          $formData["passwordCorrect"] = false;
        }
      }
      else {
        $formData["accountExists"] = false;
      }
    }
    catch (PDOException $e) {
      $data["error"] = true;
    }

  }
}

catch(PDOException $e) {
  header("Location: index.php");
  exit;
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

    <link rel="stylesheet" href="css/loginregister.css">
    <link rel="shortcut icon" href="img/logo.png">
    <title>FashaHolic | Login</title>

    <script src="https://kit.fontawesome.com/7023acb312.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <form class="" action="login.php" method="post">
      <a href="index.php" class="fas fa-chevron-circle-left"></a>
      <img src="img/logo.png" alt="">
      <h1>Login</h1>
      <div class="box">
        <p>Gebruikersnaam<span>*</span></p>
        <input type="text" name="username" value="<?php if ($username) {echo $username;} ?>" placeholder="" autocomplete="nickname" required class="text">
      </div>
      <div class="box">
        <p>Wachtwoord<span>*</span></p>
        <input type="password" name="password" value="" placeholder="" required class="text">
      </div>
      <input type="submit" name="submit" value="Login" class="submit">

      <?php
      if (!$formData["accountExists"]) {
        echo "
        <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Account bestaat niet.</p>
        ";
      }

      if (!$formData["passwordCorrect"]) {
        echo "
        <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Het wachtwoord is onjuist.</p>
        ";
      }

      if ($data["error"]) {
        echo "
        <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Er is een onbekende fout opgetreden.</p>
        ";
      }
      ?>

      <a href="register.php" class="register">Maak een account aan.<br></a>
    </form>
  </body>
</html>
