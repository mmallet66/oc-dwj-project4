<?php
$title = "Inscription";
$pageName = "registration";

ob_start();
?>
<h2>INSCRIPTION</h2><hr>

<form action="index.php?page=registration&amp;action=new" method="post">
  <div>
    <label for="login">
      <i class="fas fa-user"></i>
      <input type="text" name="login" id="login" placeholder="PSEUDO" required>
    </label>
    <label for="mail">
      <i class="fas fa-at"></i>
      <input type="email" name="mail" id="mail" placeholder="E-Mail" required>
    </label>
    <label for="password">
      <i class="fas fa-unlock"></i>
      <input type="password" name="password" id="password" placeholder="MOT DE PASSE" required>
    </label>
  </div>
  <input type="submit" name="submit" id="submit" value="INSCRIPTION">
</form>

<?php
$content = ob_get_clean();

require "template.php";
?>