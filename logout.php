<?php
require 'server/functions.php';
$connection = dbConnect();

try {
  session_start();
  session_destroy();

  header("Location: index.php");
}

catch(PDOException $e) {
  header("Location: index.php");
  exit;
}

?>
