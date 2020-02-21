<?php
$title = "Oups !";
$pageName = "error";

ob_start();
?>
<h2 id="error-message">
<?= $errorMessage ?>
</h2>
<?php
$content = ob_get_clean();

require "template.php";
?>