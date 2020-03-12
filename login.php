<?php
$hostname='localhost';
$username='root';
$password='';
$database='project_thewall';

try {
  $connection = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $accounts = $connection->query("SELECT * FROM accounts;");
  $accountExists = true;
  $passwordsCorrect = true;
  $error = false;

  $username = NULL;
  $password = NULL;

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
      $sql = "SELECT * FROM accounts WHERE username = :username";
      $parameters = [
        'username' => $username
      ];
      $stmt = $connection->prepare($sql);
      $stmt->execute($parameters);

      if ($stmt->rowCount() === 1 ) {
        $user = $stmt->fetch();
        if (password_verify($password, $user['password'])) {
          session_start();
          $_SESSION['userid'] = $user['id'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['pf'] = $user['profilepicture'];
          header("Location: index.php");
          exit;
        }
        else {
          $passwordsCorrect = false;
        }
      }
      else {
        $accountExists = false;
      }
    }
    catch (PDOException $e) {
      $error = true;
    }

  }
}

catch(PDOException $e) {
  echo "<p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Er is een onbekende fout opgetreden.</p>";
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
        <input type="text" name="username" value="" placeholder="" autocomplete="off" required class="text">
      </div>
      <div class="box">
        <p>Wachtwoord<span>*</span></p>
        <input type="password" name="password" value="" placeholder="" required class="text">
      </div>
      <input type="submit" name="submit" value="Login" class="submit">
      <?php
      if (!$accountExists) {
        echo "
        <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Account bestaat niet.</p>
        ";
      }
      if (!$passwordsCorrect) {
        echo "
        <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Het wachtwoord is onjuist.</p>
        ";
      }
      if ($error) {
        echo "
        <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Er is een onbekende fout opgetreden.</p>
        ";
      }
      ?>
      <a href="register.php" class="register">Maak een account aan.<br></a>
    </form>
  </body>
</html>
