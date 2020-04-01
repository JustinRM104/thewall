<?php

function dbConnect() {
  $config = require(__DIR__ . '/config.php');
  try {
      // Verbinding maken met gebruik van de database instellingen die in de variabelen zijn opgeslagen
      $connection = new PDO('mysql:host=' . $config['hostname'] . ';dbname=' . $config['database'], $config['username'], $config['password']);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $connection;
  }
  catch (PDOException $e) {
    echo $e->getMessage();
  }
  return false;
}

function checkUsername($username, $connection) {
  $sql = "SELECT * FROM `accounts` WHERE username = :username";
  $statement = $connection->prepare($sql);
  $params = [
    'username' => $username
  ];
  $statement->execute($params);
  return ($statement->rowCount() > 0);
}

function checkEmail($email, $connection) {
  $sql = "SELECT * FROM `accounts` WHERE email = :email";
  $statement = $connection->prepare($sql);
  $params = [
    'email' => $email
  ];
  $statement->execute($params);
  return ($statement->rowCount() > 0);
}

function checkPassLength($password) {
  $minmax = array(true, true);

  if (strlen($password) < 5) {
    $minmax[0] = false;
  }
  elseif (strlen($password) > 25) {
    $minmax[1] = false;
  }

  return $minmax;
}

function checkNameLength($username) {
  $minmax = array(true, true);

  if (strlen($username) < 4) {
    $minmax[0] = false;
  }
  elseif (strlen($username) > 15) {
    $minmax[1] = false;
  }

  return $minmax;
}
