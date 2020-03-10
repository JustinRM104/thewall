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

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

  foreach ($accounts as $key => $row) {
    if (strtolower($row["username"]) == strtolower($username)) {
      $accountExists = true;
    }
  }

  echo $username." <br>".$email." <br>".$password." <br>".$passwordHashed;


  //header("Location: index.php");
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
    <link rel="shortcut icon" href="img/logo.png">
    <title>FashaHolic | Nieuwe gebruiker</title>
  </head>
  <body>
    <?php if (!$accountExists) {
      echo "<br>Account bestaat nog niet";
    }
    else {
      echo "<br>Account bestaat al";
    }

    ?>
  </body>
</html>
