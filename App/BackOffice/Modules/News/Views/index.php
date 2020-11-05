<p style="text-align: center">Il y a actuellement <?= $newsCount ?> news. En voici la liste :</p>

<table>
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
    <?php
    foreach ($newsList as $news) { ?>
        <tr>
            <td><?= $news->getAuthor() ?></td>
            <td><?= $news->getTitle() ?></td>
            <td>le <?= $news->getCreationDate()->format('d/m/Y à H\hi') ?></td>
            <td><?= isset($news->getUpdateDate) ? "le {$news->getUpdateDate()}" : '' ?></td>
            <td><a href="news-update-<?= $news->getID()?>.html"><img src="/images/update.png" alt="Modifier" /></a> 
            <a href="news-delete-<?= $news->getID() ?>.html"><img src="/images/delete.png" alt="Supprimer" /></a></td>
        </tr>
    <?php }
    ?>
</table>
