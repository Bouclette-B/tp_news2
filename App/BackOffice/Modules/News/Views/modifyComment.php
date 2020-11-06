<form action="" method="post">
  <p>
    <?= isset($errors) && in_array(\Entity\Comment::INVALID_AUTHOR, $errors) ? 'L\'auteur est invalide.<br />' : '' ?>
    <label>Pseudo</label><input type="text" name="pseudo" value="<?= htmlspecialchars($comment->getAuthor()) ?>" /><br />
    
    <?= isset($errors) && in_array(\Entity\Comment::INVALID_CONTENT, $errors) ? 'Le contenu est invalide.<br />' : '' ?>
    <label>Contenu</label><textarea name="content" rows="7" cols="50"><?= htmlspecialchars($comment->getContent()) ?></textarea><br />
    
    <input type="hidden" name="news" value="<?= $comment->getNews()?>" />
    <input type="submit" value="Modifier" />
  </p>
</form>