<?php
$hostname='localhost';
$username='root';
$password='';
$database='project_thewall';

try {
  $connection = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $title = $_POST['title'];
  $message = $_POST['message'];

  session_start();
  if (isset($_SESSION['userid'])) {
    try {
      $sql = "INSERT INTO uploads (auteur, titel, caption) VALUES (?,?,?)";
      $stmt= $connection->prepare($sql);
      $stmt->execute([$_SESSION['username'], $title, $message]);

      header("Location: index.php");
      exit;
    }
    catch (PDOException $e) {
      header("Location: index.php");
      exit;
    }
  }
  else {
    header("Location: index.php");
    exit;
  }

}
catch(PDOException $e) {
  echo $e;
  echo "<p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Er is een onbekende fout opgetreden.</p>";
  exit;
}
?>
