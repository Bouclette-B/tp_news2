<h2><?= $news->getTitle() ?></h2>
<p><em>Écrit par <strong><?= $news->getAuthor() ?></strong>, le <?= $news->getCreationDate()->format('d/m/Y') ?></em></p>
<?php
if($news->getUpdateDate())
{
    ?><p><em><small>Modifié le <?= $news->getUpdateDate()->format('d/m/Y') ?></small></em></p><?php
}?>
<p><?= $news->getContent() ?></p>

<p><a href="comment-news<?= $news->getID() ?>.html">Ajouter un commentaire</a></p>

<?php
if (empty($comments)) {
    ?>
    <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
    <?php
}

foreach ($comments as $comment) {
    ?>
    <fieldset>
    <legend>
      Posté par <strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getDate()->format('d/m/Y à H\hi') ?>
      <?php 
      if ($user->isUserAuthenticated()) { ?> 
        - <a href="admin/modify-comment-<?= $comment->getID() ?>.html">Modifier</a> |
        <a href="admin/delete-comment-<?= $comment->getID() ?>.html">Supprimer</a>
      <?php } ?>
    </legend>
    <p><?= nl2br(htmlspecialchars($comment->getContent())) ?></p>
  </fieldset>
<?php
}
?>

<p><a href="commenter-news<?= $news->getID() ?>.html">Ajouter un commentaire</a></p>