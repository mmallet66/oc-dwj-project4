<?php
$title = "Accueil";
$pageName = "accueil";

ob_start();
?>
<h1 class="logo">Jean Forteroche</h1>

<a href="index.php?action=read-synopsis"><img src="public/img/couverture-livre.png" alt="Billet simple pour l'Alaska" /></a>

<div class="icons-container">
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
<?php
$content = ob_get_clean();

require "template.php";
?>