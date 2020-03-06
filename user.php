<?php
$hostname='localhost';
$username='root';
$password='';
$database='project_thewall';

try {
  $connection = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $accounts = $connection->query("SELECT * FROM accounts;");

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
  

  //header("Location: index.php");
}

catch(PDOException $e) {
  echo "Something gone wrong while connecting to the database.";
  exit;
}

?>
