<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/style-global.css">
  <link rel="stylesheet" href="public/css/style-front-office.css">
  <title><?= $title;?> - Jean Forteroche</title>
</head>

<body class="front-office">

  <nav id="nav">

    <div id="nav-button">
      <i class="fas fa-bars"></i>
      <input type="checkbox" name="nav-check" id="nav-check" />
    </div>

    <div id="menu">

      <h2 id="menu-title" class="logo">Jean Forteroche</h2>
      <div id="menu-content">

        <img class="menu-separator menu-separator-1" src="public/img/trenner3.svg" alt="separator">

        <ul id="menu-list">
          <li><a href="index.php">Accueil</a></li>
          <li><a href="index.php?page=read">Lecture</a></li>
          <li><a href="index.php?page=about">À propos</a></li>
          <li><a href="index.php?page=login">Connexion</a></li>
        </ul>
        <img class="menu-separator menu-separator-2" src="public/img/trenner3.svg" alt="separator">
      </div>

      <div class="icons-container menu-icons-container">
          <a class="icon-circle" href="https://www.facebook.fr/">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a class="icon-circle" href="https://www.twitter.fr/">
            <i class="fab fa-twitter"></i>
          </a>
          <a class="icon-circle" href="https://www.pinterest.fr/">
            <i class="fab fa-pinterest-p"></i>
          </a>
          <a class="icon-circle" href="https://www.linkedin.com/">
            <i class="fab fa-linkedin-in"></i>
          </a>
      </div>

    </div>
  </nav>
  <?php
  if($pageName != "accueil")
  {?>
  <header>
    <h1 class="logo">Jean Forteroche</h1>
  </header>
  <?php
  }
  ?>

  <section id="content-container" class="<?= $pageName;?>">
  <?= $content;?>
  </section>

  <script src="public/js/script.js"></script>
</body>
</html>