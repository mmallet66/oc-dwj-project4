<?php
$pageName = "administration";

ob_start();
?>
<h2>Administration</h2>
<article id="content">
  <table>
    <thead>
      <tr>
        <th>N°</th>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>
    
    <tbody>
      <?php
      while($chapterData = $chapters->fetch())
      {
        $this->chapter->hydrate($chapterData);
      ?>
      <tr>
        <td><?= strip_tags($this->chapter->getNumber()) ?></td>
        <td><?= strip_tags($this->chapter->getTitle()) ?></td>
        <td><?= substr(strip_tags($this->chapter->getContent()), 0, 200) . "..." ?></td>
        <td><?= ($this->chapter->getPublished()) ? "Publié" : "Brouillon"; ?></td>
        <td>
          <a href="index.php?status=admin&amp;action=edit&amp;chapterId=<?= $this->chapter->getId() ?>" title="Éditer"><i class="edit fa fa-edit"></i></a>
          <a href="index.php?status=admin&amp;action=publish&amp;chapterId=<?= $this->chapter->getId() ?>" title="Publier"><i class="view fa fa-eye"></i></a>
          <a href="index.php?status=admin&amp;action=delete&amp;chapterId=<?= $this->chapter->getId() ?>" title="Supprimer"><i class="trash fa fa-trash"></i></a>
        </td>
      </tr>
      <?php
      }
      ?>
      <tr>
        <td colspan="4"><a href="index.php?status=admin&amp;action=write">Nouveau Chapitre</a></td>
      </tr>
    </tbody>
    
  </table>
</article>
<?php
$content = ob_get_clean();

require "template.php";
?>