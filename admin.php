<?php
require 'class/articlemanagers.php';
require 'class/article.php';

$db = new PDO('mysql:host=localhost;dbname=article', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$manager = new ArticleManagers($db);

if (isset($_GET['modifier']))
{
    $article = $manager->getUnique((int) $_GET['modifier']);
}

if (isset($_GET['supprimer']))
{
    $manager->delete((int) $_GET['supprimer']);
    $message = 'L article a bien été supprimé !';
}

if (isset($_POST['auteur']))
{
    $article = new Article(
        [
            'auteur' => $_POST['auteur'],
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu']
        ]
    );

    if (isset($_POST['id']))
    {
        $article->setId($_POST['id']);
    }

    if ($article->isValid())
    {
        $manager->save($article);

        $message = $article->isNew() ? 'L article a bien été ajouté !' : 'L article a bien été modifié !';
    }
    else
    {
        $erreurs = $article->erreurs();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administration</title>
    <meta charset="utf-8" />

    <style type="text/css">
        table, td {
            border: 1px solid black;
        }

        table {
            margin:auto;
            text-align: center;
            border-collapse: collapse;
        }

        td {
            padding: 3px;
        }
    </style>
</head>

<body>
<p><a href=".">Accéder à l'accueil du site</a></p>

<form action="admin.php" method="post">
    <p style="text-align: center">
        <?php
        if (isset($message))
        {
            echo $message, '<br />';
        }
        ?>
        <?php if (isset($erreurs) && in_array(Article::AUTEUR_INVALIDE, $erreurs)) echo 'L\'auteur est invalide.<br />'; ?>
        Auteur : <input type="text" name="auteur" value="<?php if (isset($article)) echo $article->auteur(); ?>" /><br />

        <?php if (isset($erreurs) && in_array(Article::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
        Titre : <input type="text" name="titre" value="<?php if (isset($article)) echo $article->titre(); ?>" /><br />

        <?php if (isset($erreurs) && in_array(Article::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
        Contenu :<br /><textarea rows="8" cols="60" name="contenu"><?php if (isset($article)) echo $article->contenu(); ?></textarea><br />
        <?php
        if(isset($article) && !$article->isNew())
        {
            ?>
            <input type="hidden" name="id" value="<?= $article->id() ?>" />
            <input type="submit" value="Modifier" name="modifier" />
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

<p style="text-align: center">Il y a actuellement <?= $manager->count() ?> article. En voici la liste :</p>

<table>
    <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
    <?php
    foreach ($manager->getList() as $article)
    {
        echo '<tr><td>', $article->auteur(), '</td><td>', $article->titre(), '</td><td>', $article->dateAjout()->format('d/m/Y à H\hi'), '</td><td>', ($article->dateAjout() == $article->dateModif() ? '-' : $article->dateModif()->format('d/m/Y à H\hi')), '</td><td><a href="?modifier=', $article->id(), '">Modifier</a> | <a href="?supprimer=', $article->id(), '">Supprimer</a></td></tr>', "\n";}
    ?>
</table>
</body>
</html>