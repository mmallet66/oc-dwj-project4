<?php
$pageName = "moderation";

ob_start();
?>
<h2>Modération</h2>
<article id="content">
  <div>

  </div>
  <table>
    <thead>
      <tr>
        <th>Auteur</th>
        <th>Titre du Chapitre</th>
        <th>Contenu</th>
        <th>Signalé ?</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($commentData = $commentsReported->fetch())
      {
        $this->comment->hydrate($commentData);
      ?>
      <tr>
        <td><?= ($this->comment->getAuthorLogin()) ? htmlspecialchars($this->comment->getAuthorLogin()) : "Anonyme"; ?></td>
        <td><?= $this->comment->getChapterTitle() ?></td>
        <td><?= htmlspecialchars($this->comment->getContent()) ?></td>
        <td>
        <?php
        if($this->comment->getReported()):
          echo "oui <a href='index.php?status=admin&action=unreport-comment&commentId="
            . $this->comment->getId()
            . "' title='Désignaler'><i class='fas fa-check'></i></a>";
        else:
          echo "non";
        endif;
        ?>
        </td>
        <td>
          <a href="" title="Supprimer"><i class="trash fa fa-trash"></i></a>
        </td>
      </tr>
      <?php
      }
      ?>
    </tbody>
    
  </table>
</article>
<?php
$content = ob_get_clean();

require "template.php";
?>