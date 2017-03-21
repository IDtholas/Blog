<?php
require 'class/article.php';
require 'class/articlemanagers.php';

$db = new PDO('mysql:host=localhost;dbname=article', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$manager = new ArticleManagers($db);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil du site</title>
    <meta charset="utf-8" />
</head>

<body>
<p><a href="admin.php">Accéder à l'espace d'administration</a></p>
<?php
if (isset($_GET['id']))
{
    $article = $manager->getUnique((int) $_GET['id']);

    echo '<p>Par <em>', $article->auteur(), '</em>, le ', $article->dateAjout()->format('d/m/Y à H\hi'), '</p>', "\n",
    '<h2>', $article->titre(), '</h2>', "\n",
    '<p>', nl2br($article->contenu()), '</p>', "\n";

    if ($article->dateAjout() != $article->dateModif())
    {
        echo '<p style="text-align: right;"><small><em>Modifiée le ', $article->dateModif()->format('d/m/Y à H\hi'), '</em></small></p>';
    }
}

else
{
    echo '<h2 style="text-align:center">Liste des 5 dernières news</h2>';

    foreach ($manager->getList(0, 5) as $article)
    {
        if (strlen($article->contenu()) <= 200)
        {
            $contenu = $article->contenu();
        }

        else
        {
            $debut = substr($article->contenu(), 0, 200);
            $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

            $contenu = $debut;
        }

        echo '<h4><a href="?id=', $article->id(), '">', $article->titre(), '</a></h4>', "\n",
        '<p>', nl2br($contenu), '</p>';
    }
}
?>
</body>
</html>