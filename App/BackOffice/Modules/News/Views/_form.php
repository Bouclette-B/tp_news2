<form action="" method="post">
  <p>
    <?= isset($errors) && in_array(\Entity\News::INVALID_AUTHOR, $errors) ? 'L\'auteur est invalide.<br />' : '' ?>
    <label>Auteur</label>
    <input type="text" name="author" value="<?= isset($news) ? $news->getAuthor() : '' ?>" /><br />
    
    <?= isset($errors) && in_array(\Entity\News::INVALID_TITLE, $errors) ? 'Le titre est invalide.<br />' : '' ?>
    <label>Titre</label><input type="text" name="title" value="<?= isset($news) ? $news->getTitle() : '' ?>" /><br />
    
    <?= isset($errors) && in_array(\Entity\News::INVALID_CONTENT, $errors) ? 'Le contenu est invalide.<br />' : '' ?>
    <label>Contenu</label><textarea rows="8" cols="60" name="content"><?= isset($news) ? $news->getContent() : '' ?></textarea><br />
<?php
if(isset($news) && !$news->isNew())
{
?>
    <input type="hidden" name="id" value="<?= $news->getID() ?>" />
    <input type="submit" value="Modifier" name="update" />
<?php
}
else
{
?>
    <input type="submit" value="Ajouter" />
<?php
}
?>
  </p>
</form>