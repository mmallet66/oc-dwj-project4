<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php
  if(!empty($scriptTags)):
    echo $scriptTags[0];
  endif;
  ?>
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/style-global.css">
  <link rel="stylesheet" href="public/css/style-back-office.css">
  <title>Espace Administrateur - Jean Forteroche</title>
</head>

<body class="back-office">

  <nav id="nav">

    <div id="menu">

      <div id="menu-content">

        <img class="menu-separator menu-separator-1" src="public/img/trenner3.svg" alt="separator">

        <ul id="menu-list">
          <li><a href="index.php?status=admin&amp;action=administration">Administration</a></li>
          <li><a href="index.php?status=admin&amp;action=moderation">Modération</a></li>
        </ul>
        <img class="menu-separator menu-separator-2" src="public/img/trenner3.svg" alt="separator">
      </div>

    </div>
  </nav>
  
  <header>
    <h1 class="logo"><a href="index.php">Jean Forteroche</a></h1>
    <a href="index.php?action=disconnect">Déconnexion</a>
  </header>

  <section id="content-container" class="<?= $pageName ?>">
    <?= $content ?>
  </section>

<?php
if(!empty($scriptTags)):
  echo $scriptTags[1];
endif;
?>
</body>
</html>