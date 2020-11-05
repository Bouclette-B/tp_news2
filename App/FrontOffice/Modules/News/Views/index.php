<?php
foreach ($newsList as $news) { ?>
    <h2><a href="news-<?= $news->getId() ?>.html"><?= $news->getTitle() ?></a></h2>
    <p><?= $news->getContent() ?></p>
<?php }

