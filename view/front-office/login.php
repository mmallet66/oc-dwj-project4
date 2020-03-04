<?php
$title = "Connexion";
$pageName = "login";

ob_start();
?>
<h2>CONNEXION</h2><hr>
<?php if(isset($errorLogin))
{
  echo "<p style='color: #d43232; text-align:center;'>Le Nom d'utilisateur, ou le mot de passe, est erroné.</p>";
}
?>
<form action="index.php?action=connect" method="post">
  <div>
    <label for="username">
      <i class="fas fa-user"></i>
      <input type="text" name="username" id="username" placeholder="PSEUDO" required>
    </label>
    <label for="password">
      <i class="fas fa-unlock"></i>
      <input type="password" name="password" id="password" placeholder="MOT DE PASSE" required>
    </label>
  </div>
  <input type="submit" name="submit" id="submit" value="CONNEXION">
</form>

<p>Pas de compte utilisateur ? <a id="registration" href="index.php?action=registration">Inscrivez vous</a>.</p>
<?php
$content = ob_get_clean();

require "template.php";
?>