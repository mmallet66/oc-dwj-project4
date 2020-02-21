<?php
$title = "Connexion";
$pageName = "login";

ob_start();
?>
<h2>CONNEXION</h2><hr>

<form action="#" method="post">
  <div>
    <label for="username">
      <i class="fas fa-user"></i>
      <input type="text" name="username" id="username" placeholder="USERNAME">
    </label>
    <label for="password">
      <i class="fas fa-unlock"></i>
      <input type="password" name="password" id="password" placeholder="PASSWORD">
    </label>
  </div>
  <input type="submit" name="submit" id="submit" value="CONNEXION">
</form>
<?php
$content = ob_get_clean();

require "template.php";
?>