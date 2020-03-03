<?php
$title = "Billet simple pour l'Alaska";
$pageName = "read-synopsis";

ob_start();
?>
<div>
  <img src="public/img/couverture-livre.png" alt="Billet simple pour l'Alaska" />
  <article>
    <div>
      <h2><?= $this->chapter->getTitle() ?></h2>
      <p><?= $this->chapter->getContent() ?></p>
    </div>
    <form action="index.php?action=read-chapter" method="post">
      <label for="chapterId">Choisir un chapitre :</label>
      <select name="chapterId">
        <option value="">-- Choisir --</option>
      <?php
      while($line = $data->fetch())
      {
        $chapter = new Chapter;
        $chapter->hydrate($line);?>

        <option value= <?= $chapter->getId(); ?> >Chapitre <?= $chapter->getNumber(); ?> </option>
      <?php
      }
      ?>
      </select>
      <input type="submit" value="Valider">
    </form>
  </article>
</div>
<?php
$content = ob_get_clean();

require "template.php";
?>