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
    <form class="" action="user.php" method="post">
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
      <a href="register.php" class="register">Of maak een account aan.<br></a>
      <input type="submit" name="" value="Login" class="submit">
    </form>
  </body>
</html>
