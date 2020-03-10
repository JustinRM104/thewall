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
    <form class="" action="user.php" method="post">
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

      <input type="submit" name="" value="Registreer" class="submit">
      <a href="login.php" class="register">Al een account? Login.<br></a>
    </form>
  </body>
</html>
