<?php
$title = "Chapitre " . $_POST["number"];
$pageName = "read-chapter";

ob_start();
?>
<div>
  <article id="chapter-content">
    <?= $this->chapter->getTitle(); ?>
    <?= $this->chapter->getContent(); ?>
  </article>
  <article id="comments-container">
    <div id="head">
      <hr><p>Commentaires</p><hr>
    </div>

    <div id="comment-form-container">
      <hr>
      <p><i class="fa fa-angle-down"></i>Écrire un commentaire<i class="fa fa-angle-down"></i></p>
      <input type="checkbox" name="" id="check">
      <form id="comment-form">
        <input type="text" name="author" id="author" placeholder="Votre Nom" required>
        <textarea name="comment-content" id="comment-editor" cols="30" rows="10" placeholder="Saisissez votre commentaire" required></textarea>
        <input type="submit" value="Envoyer">
      </form>
      <hr>
    </div>
    
    
    <ul id="comments">
      <?php
      while($commentData = $comments->fetch())
      {
        $this->comment->hydrate($commentData);
      ?>
      <li class="comment">
        <p class="comment-header">
          <span>
            <strong><?= $this->comment->getAuthor() ?></strong>
            , le <?= $this->comment->getDateComment() ?> :
          </span>
          <a href="index.php?page=read&amp;report=1">Signaler</a>
        </p>
        <p class="comment-content"><?= $this->comment->getContent() ?></p>
      </li>
      <?php
      }
      ?>
    </ul>
  </article>
</div>
<?php
$content = ob_get_clean();

require "template.php";
?>