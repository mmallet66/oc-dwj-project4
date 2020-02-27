<?php
$pageName = "accueil";

ob_start();
?>
<article id="content">
  <h2>Bonjour et bienvenue sur votre espace d'administation</h2>
  <div>
    <i class="far fa-arrow-alt-circle-left"></i>
    <ul>
      <li>Administration = Gestion des chapitres</li>
      <li>Modération = Gestion des commentaires</li>
    </ul>
  </div>
</article>
<?php
$content = ob_get_clean();

require "template.php";
?>