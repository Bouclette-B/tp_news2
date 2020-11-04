<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : "TP NEWS, Le retour" ?></title>
    <link rel="stylesheet" href="/css/Envision.css" type="text/css">
</head>
<body>
    <div id="wrap">
        <header>
            <h1><a href="/">TP NEWS, Le retour</a></h1>
            <p>Le vide</p>
        </header>

        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <?php if ($user->isUserAuthenticated()) { ?>
                <li><a href="/admin">Admin</a></li>
                <li><a href="/admin/news-insert.html"></a>Ajouter une news</li>
            <?php } ?>
            </ul>
        </nav>

        <div id="content-wrap">
            <section id="main">
                <?php if($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
                <?= $content ?>
            </section>
        </div>

        <footer></footer>

    </div>
    
</body>
</html>