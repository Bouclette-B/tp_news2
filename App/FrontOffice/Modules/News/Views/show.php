<h2><?= $news->getTitle() ?></h2>
<p><em>Écrit par <strong><?= $news->getAuthor() ?></strong>, le <?= $news->getCreationDate()->format('d/m/Y') ?></em></p>
<?php
if($news->getUpdateDate())
{
    ?><p><em><small>Modifié le <?= $news->getUpdateDate()->format('d/m/Y') ?></small></em></p><?php
}?>
<p><?= $news->getContent() ?></p>