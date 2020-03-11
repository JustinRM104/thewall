<?php
$hostname='localhost';
$username='root';
$password='';
$database='project_thewall';

try {
  $connection = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $accounts = $connection->query("SELECT * FROM accounts;");
  $accountExists = false;
  $emailExists = false;
  $passwordsCorrect = true;
  $error = false;
  $minLength = true;

  $username = NULL;
  $email = NULL;
  $password = NULL;
  $confirmedPass = NULL;
  $passwordHashed = NULL;

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmedPass = $_POST['cpassword'];
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    foreach ($accounts as $key => $row) {
      if (strtolower($row["username"]) == strtolower($username)) {
        $accountExists = true;
      }
      if (strtolower($row["email"]) == strtolower($email)) {
        $emailExists = true;
      }
    }

    if (!($password == $confirmedPass)) {
      $passwordsCorrect = false;
    }

    if (strlen($password) < 5) {
      $minLength = false;
    }

    if ($minLength && $passwordsCorrect && !($accountExists || $emailExists)) {
      //$sql = "INSERT INTO accounts (username, password, email) VALUES ($username, $passwordHashed, $email)";
      try {
        $sql = "INSERT INTO accounts (username, `password`, email) VALUES (?,?,?)";
        $stmt= $connection->prepare($sql);
        $stmt->execute([$username, $passwordHashed, $email]);
        header("Location: index.php");
        exit;
      }
      catch (PDOException $e) {
        $error = true;
      }
    }
  }
}

catch(PDOException $e) {
  echo "Something gone wrong while connecting to the database.";
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
    <title>FashaHolic | Registreer</title>

    <script src="https://kit.fontawesome.com/7023acb312.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <form class="" action="register.php" method="post">
      <a href="index.php" class="fas fa-chevron-circle-left"></a>
      <img src="img/logo.png" alt="">
      <h1>Maak een Account</h1>
      <div class="box">
        <p>Gebruikersnaam<span>*</span></p>
        <input type="text" name="username" value="" placeholder="" autocomplete="off" required class="text">
      </div>
      <div class="box">
        <p>Email<span>*</span></p>
        <input type="email" name="email" value="" placeholder="" required class="text">
      </div>
      <div class="box">
        <p>Wachtwoord<span>*</span></p>
        <input type="password" name="password" value="" placeholder="" required class="text">
      </div>
      <div class="box">
        <p>Bevestig wachtwoord<span>*</span></p>
        <input type="password" name="cpassword" value="" placeholder="" required class="text">
      </div>
      <p class="policy">By clicking Sign up, You agree to our Terms
        and that you have read our Data Use Policy.
      </p>

      <input type="submit" name="submit" value="Registreer" class="submit">

       <?php
       if ($accountExists) {
         echo "
         <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Gebruikersnaam is al in gebruik.</p>
         ";
       }
       if ($emailExists) {
         echo "
         <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Email is al in gebruik.</p>
         ";
       }
       if (!$passwordsCorrect) {
         echo "
         <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Wachtwoorden komen niet overeen.</p>
         ";
       }
       if ($error) {
         echo "
         <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Er is een onbekende fout opgetreden.</p>
         ";
       }
       if (!$minLength) {
         echo "
         <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Het wachtwoord moet minimaal uit 5 karakters bestaan.</p>
         ";
       }
       ?>

      <a href="login.php" class="register">Al een account? Login.<br></a>
    </form>
  </body>
</html>
