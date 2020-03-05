<?php
session_start();
$title = "Chapitre " . $this->chapter->getId();
$pageName = "read-chapter";

ob_start();
?>
<div>
  <article id="chapter-content">
    <h2 style="text-align:center;"><?= $this->chapter->getTitle(); ?></h2>
    <?= $this->chapter->getContent(); ?>
  </article>
  <article id="comments-container">
    <div id="head">
      <hr><p>Commentaires</p><hr>
    </div>

    <?php
    if(isset($_SESSION["userId"])):
    ?>
    <div id="comment-form-container">
      <hr>
      <p><i class="fa fa-angle-down"></i>Écrire un commentaire<i class="fa fa-angle-down"></i></p>
      <input type="checkbox" id="check">
        <form action="index.php?action=new-comment&amp;authorId=<?= $_SESSION["userId"] ?>&amp;chapterId=<?= $this->chapter->getId(); ?>" method="POST" id="comment-form">
          <textarea name="content" id="comment-editor" cols="30" rows="10" placeholder="Saisissez votre commentaire" required></textarea>
          <input type="submit" value="Envoyer">
        </form>
      <hr>
    </div>
    <?php
    endif;
    ?>
    
    <ul id="comments">
      <?php
      while($commentData = $comments->fetch())
      {
        $comment = new Comment();
        $comment->hydrate($commentData);
      ?>
      <li class="comment">
        <p class="comment-header">
          <span>
            <strong><?= ($comment->getAuthorLogin()) ? htmlspecialchars($comment->getAuthorLogin()) : "Anonyme"; ?></strong>
            , le <?= $comment->getDateComment() ?> :
          </span>
          <?php
          if($comment->getReported() == 0){?>
          <a href="index.php?action=report-comment&amp;commentId=<?= $comment->getId() ?>">Signaler</a>
          <?php }; ?>
        </p>
        <p class="comment-content"><?= htmlspecialchars($comment->getContent()) ?></p>
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