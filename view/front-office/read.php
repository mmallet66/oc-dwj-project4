<?php
$title = "Billet simple pour l'Alaska";
$pageName = "read-synopsis";

ob_start();
?>
<div>
  <img src="public/img/couverture-livre.png" alt="Billet simple pour l'Alaska" />
  <article>
    <div>
      <h2>Synopsis</h2>
      <p>Lundi ! Le jour de reprise ! Pierre est un jeune banquier. Chaque matin il se lève, se lave, prend son petit déjeuner, monte dans sa voiture, et cottoie ses camarades dans des bouchons interminables qui rallongent son trajet de près d'une heure ...</p>
      <p>Pierre était un adolescent joyeux, motivé avec des rêves plein la tête. Aujourd'hui il n'est plus qu'un jeune adulte déjà désabusé par cette vie qui lui en demande sans cesse toujours plus pour ne lui rendre que trop peu. Ce matin dans sa voiture il cherche une station de radio qui pourrait le faire s'évader ne serait ce que le temps de ce bouchon qui n'en finit pas. 101.5fm, Radio Nova ... Édouard Baer, un acteur qu'il apprécie s'exprime : "Partez, prenez la tangente, le pas de côté, l'école buissonnière. L'inconnu commence là, au bas de la rue. L'aventure est là, là où on ne s'y attend pas. Abandonnez tout, veaux, vaches, cochons, vos milles obligations, prison, raison et même, même les sentiments qui nous attachent. Les liens, coupez les !, vous les retrouverez un jour, vieux, plein d'usage et raison, vous retrouverez le chemin de votre maison; mais en attendant sentez ce souffle, sentez le qui vous prend. Là près de vous il doit y avoir un cours d'eau, un ruisseau, une mer ou un océan, une marre au diable, une marre aux canards, quelque chose, un cours d'eau qui nous relie au grand bleu. Vous êtes là ? Une embarcation, un rafiot, un paquebot, un bateau ou une moto ... mettez vous dedans, c'est parti, guettez le vent ...".</p>
      <p>À ce moment Pierre n'est plus dans sa réalité, il prends la première sortie et se dirige vers l'aéroport, la voilà son embarcation ... advienne que pourra se dit-il. Et si demain commençait une autre vie !</p>
    </div>
    <form action="index.php?page=read" method="post">
      <label for="number">Choisir un chapitre :</label>
      <select name="number">
        <option value="">-- Choisir --</option>
      <?php
      while($line = $data->fetch())
      {
        $chapter->hydrate($line);
        $number = $chapter->getNumberOrder()?>
        <option value= <?= $number; ?> >Chapitre <?= $number; ?> </option>
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