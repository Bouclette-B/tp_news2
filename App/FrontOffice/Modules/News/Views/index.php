<?php
foreach ($newsList as $news) { ?>
    <h2><a href="news-<?= $news['id'] ?>.html"><?= $news['title'] ?></a></h2>
    <p><?= $news['content'] ?></p>
<?php }