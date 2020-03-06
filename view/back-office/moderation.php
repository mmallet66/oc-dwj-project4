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
        <td><?= $this->comment->getAuthorLogin() ?></td>
        <td><?= $this->comment->getChapterTitle() ?></td>
        <td><?= $this->comment->getContent() ?></td>
        <td><?= ($this->comment->getReported()) ? "oui <a href='' title='Désignaler'><i class='fas fa-check'></i></a>" : "non" ?></td>
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