<!DOCTYPE html>
<html lang="nl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Justin Rodriguez Montoya, Mike Yang">
    <meta name="keywords" content="feed, fashion, kleding, streetware, jongvolwassen, broek, trui, verhaal, sociaal">
    <meta name="description" content="">

    <link rel="stylesheet" href="master.css">
    <link rel="shortcut icon" href="img/logo.png">
    <title>FashionSwipe | Feed</title>

    <script src="https://kit.fontawesome.com/7023acb312.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="bg"></div>

    <nav>

    </nav>

    <div class="feed">
      <div class="top" id="top">
        <h2><span class="fas fa-comments"></span> Feed</h2>
      </div>
      <form class="messageBox" action="index.html" method="post">
        <input type="title" name="title" value="" placeholder="Titel" class="title" autocomplete="off" required>
        <textarea name="message" rows="8" cols="80" placeholder="Plaats een bericht" required></textarea>
        <div class="functions">
          <input type="file" id="real-file" hidden="hidden">
          <button type="button" id="custom-button">FOTO TOEVOEGEN</button>
          <span id="custom-text"></span>
        </div>
        <a href="#temp"><span class="far fa-paper-plane send"></span> Plaats</a>
      </form>
      <div class="posts">
        <section>
          <div class="icons">
            <h5 class="fas fa-heart like"> <span>0</span></h5>
            <h5 class="fas fa-bookmark save"> <span></span></h5>
          </div>
          <img src="img/defaultuser.jpg" alt="" class="profilePicture">
          <h2>Gebruiker<span> · 27 feb. 2020</span></h2>
          <h3>Test titel</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </section>
        <section>
          <div class="icons">
            <h5 class="fas fa-heart like"> <span>0</span></h5>
            <h5 class="fas fa-bookmark save"> <span></span></h5>
          </div>
          <img src="img/defaultuser.jpg" alt="" class="profilePicture">
          <h2>Gebruiker<span> · 27 feb. 2020</span></h2>
          <h3>Test titel</h3>
          <p>Lorem ipsum dolort, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </section>
        <section>
          <div class="icons">
            <h5 class="fas fa-heart like"> <span>0</span></h5>
            <h5 class="fas fa-bookmark save"> <span></span></h5>
          </div>
          <img src="img/defaultuser.jpg" alt="" class="profilePicture">
          <h2>Gebruiker<span> · 21 feb. 2020</span></h2>
          <img src="https://scontent-ams4-1.cdninstagram.com/v/t51.2885-15/e35/p1080x1080/87740525_191727465413498_4868163905584137233_n.jpg?_nc_ht=scontent-ams4-1.cdninstagram.com&_nc_cat=1&_nc_ohc=vCh61CECTxcAX_gjWFa&oh=9347444b535879dbb08f7c79e8fcdd75&oe=5E89E527" alt="foto" class="postImg">
          <h3>Test titel</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </section>
      </div>
      <h3 class="end">Dat was alles!</h3>
      <a href="#top" class="fas fa-angle-double-up"></a>
    </div>

    <script src="upload.js"></script>
  </body>
</html>
