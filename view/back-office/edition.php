<?php
$scriptTags = [
  "<script src='https://cdn.tiny.cloud/1/02px3gr91huynbb96wru2hdri987o8bw3fq77f6extwlub4n/tinymce/5/tinymce.min.js' referrerpolicy='origin'></script>",
  "<script src='public/js/tinymce/tinymce.js'></script>"];

$pageName = "edition";

ob_start();
?>
<h2>Edition</h2>
<article id="content">
  <?php
  if(!$this->chapter->getId()):
  ?>
  <form action="index.php?status=admin&amp;action=create-chapter" method="POST">
  <?php
  else:
  ?>
    <form action="index.php?status=admin&amp;action=update-chapter&amp;chapterId=<?= $this->chapter->getId() ?>" method="POST">
  <?php
  endif;
  ?>
    <label for="number">Numéro du chapitre : <input type="text" name="number" id="chapter-number" value="<?= $this->chapter->getNumber() ?>" required/></label>
    <label for="title">Titre du chapitre : <input type="text" name="title" id="chapter-title" value="<?= $this->chapter->getTitle() ?>"/></label>
    <textarea name="content" id="chapter-content" cols="30" rows="42"><?= $this->chapter->getContent() ?></textarea>
    <input id="submit" type="submit" value="Enregistrer">
  </form>
</article>
<?php
$content = ob_get_clean();

require "template.php";
?>