<?php
require 'server/functions.php';
$connection = dbConnect();

$data = array(
  "loggedIn"=> false,
  "error"=> false
);

$formData = array(
  'nameExists' => false,
  'emailExists' => false,
  'min' => true,
  'max' => true,
  'emailCorrect' => true,
  'passwordCorrect' => true
);

try {
  // Get $accounts
  $accounts = $connection->query("SELECT * FROM accounts;");

  // Session Check
  session_start();
  if (isset($_SESSION['user_id'])) {
    $data["loggedIn"] = true;

    header("Location: index.php");
    exit;
  }

  $username = NULL;
  $email = NULL;
  $password = NULL;
  $confirmPassword = NULL;
  $passwordHashed = NULL;

  // Check if user submitted
  if (isset($_POST['submit'])) {
    // Data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['cpassword'];
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    // Check name and email
    $formData["nameExists"] = checkUsername($username, $connection);
    $formData["emailExists"] = checkEmail($email, $connection);

    // Check pass length
    $length = checkPassLength($password);
    $formData["min"] = $length[0];
    $formData["max"] = $length[1];

    // Check pass
    if (!($password == $confirmPassword)) {
      $formData["passwordCorrect"] = false;
    }

    // Lets register the user if no errors
    if (($formData["min"] && $formData["max"] && $formData["passwordCorrect"]) && !($formData["nameExists"] || $formData["emailExists"])) {
      try {
        $sql = "INSERT INTO accounts (username, email, `password`) VALUES (?,?,?)";
        $stmt= $connection->prepare($sql);
        $stmt->execute([$username, $email, $passwordHashed]);

        $sql2 = "SELECT * FROM accounts WHERE username = :username";
        $parameters = ['username' => $username];
        $stmt2 = $connection->prepare($sql2);
        $stmt2->execute($parameters);
        $user = $stmt2->fetch();

        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;

        header("Location: index.php");
        exit;

      } catch (PDOException $e) {
        $data["error"] = true;
      }

    }
  }

} catch(PDOException $e) {
  // We sturen gebruiker terug naar home pagina.
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
        <input type="text" name="username" value="<?php if ($username) {echo $username;} ?>" autocomplete="nickname" required class="text">
      </div>
      <div class="box">
        <p>Email<span>*</span></p>
        <input type="email" name="email" value="<?php if ($email) {echo $email;} ?>" autocomplete="email" required class="text">
      </div>
      <div class="box">
        <p>Wachtwoord<span>*</span></p>
        <input type="password" name="password" value="" required class="text">
      </div>
      <div class="box">
        <p>Bevestig wachtwoord<span>*</span></p>
        <input type="password" name="cpassword" value="" required class="text">
      </div>
      <p class="policy">Door te registreren gaat u akkoord met onze algemene voorwaarden.</p>

      <input type="submit" name="submit" value="Registreer" class="submit">

       <?php
       if ($formData["nameExists"]) {
         echo "
         <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Gebruikersnaam is al in gebruik.</p>
         ";
       }

       if ($formData["emailExists"]) {
         echo "
         <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Email is al in gebruik.</p>
         ";
       }

       if (!$formData["passwordCorrect"]) {
         echo "
         <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Wachtwoorden komen niet overeen.</p>
         ";
       }

       if (!$formData["min"] || !$formData["max"]) {
         echo "
         <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Het wachtwoord moet tussen de 5 en 20 karakters bestaan.</p>
         ";
       }

       if ($data["error"]) {
         echo "
         <p style=\"color: red; text-align: center; margin-top: 1em; text-shadow: 0px 0px .5em #ff9999;\">Er is een onbekende fout opgetreden.</p>
         ";
       }
       ?>

      <a href="login.php" class="register">Al een account? Login.<br></a>
    </form>
  </body>
</html>
