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
    <div class="feed">
      <div class="top">
        <h2><span class="fas fa-comments"></span> Feed</h2>
      </div>
      <form class="messageBox" action="index.html" method="post">
        <input type="title" name="title" value="" placeholder="Titel" class="title" required>
        <textarea name="message" rows="8" cols="80" placeholder="Plaats een bericht" required></textarea>
        <div class="functions">
          <input type="file" class="upload" name="filename" accept=".jpg, .jpeg, .png">
        </div>
        <a href="#temp"><span class="far fa-paper-plane send"></span> Plaats</a>
      </form>
      <div class="posts">
        <section>
          <h2><span>Gebruiker</span> - Titel</h2>
          <p>hallo</p>
          <img src="https://cdn.shopify.com/s/files/1/0039/4225/2662/products/product-image-438717472.jpg?v=1538384920" alt="">

        </section>
      </div>
    </div>
  </body>
</html>
