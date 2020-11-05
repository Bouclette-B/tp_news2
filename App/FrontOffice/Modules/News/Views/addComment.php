<h2>Ajouter un commentaire</h2>
<form action="" method="post">
  <p>
    <?= isset($errors) && in_array(\Entity\Comment::INVALID_AUTHOR, $errors) ? 'L\'auteur est invalide.<br />' : '' ?>
    <label>Pseudo</label>
    <input type="text" name="pseudo" value="<?= isset($comment) ? htmlspecialchars($comment->getAuthor()) : '' ?>" /><br />
    
    <?= isset($errors) && in_array(\Entity\Comment::INVALID_CONTENT, $errors) ? 'Le contenu est invalide.<br />' : '' ?>
    <label>Contenu</label>
    <textarea name="content" rows="7" cols="50"><?= isset($comment) ? htmlspecialchars($comment->getContent()) : '' ?></textarea><br />
    
    <input type="submit" value="Commenter" />
  </p>
</form>