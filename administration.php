<?php
require 'class/articlemanagers.php';
require 'class/article.php';

require 'connexion.php';
$manager = new ArticleManagers($db);

if (isset($_GET['modifier']))
{
    $article = $manager->getUnique((int) $_GET['modifier']);
}

if (isset($_GET['supprimer']))
{
    $manager->delete((int) $_GET['supprimer']);
    $message = '<div class="alert alert-success fade in"> L article a bien été supprimé !</div>';
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

        $message = $article->isNew() ? '<div class="alert alert-success fade in">L article a bien été ajouté !</div>' : ' <div class="alert alert-success fade in">L article a bien été modifié ! </div>';
    }
    else
    {
        $erreurs = $article->erreurs();
    }
}

?>

<html>
<head>
    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <title>Accueil du site</title>
    <meta charset="utf-8" />
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        #pied{ text-align: center;}
    </style>
</head>

<body>
<div class="container">
<?php
include "header.php";
?>
    <section class="col-sm-8">
    <form class="well" action="administration.php" method="post">
        <legende><h2>Ajoutez un article: </h2></legende>
        <fieldset>
        <?php
        if (isset($message))
        {
            echo '<div class="row"> <div class="col-lg-12">', $message, '<br /></div></div>';
        }
        ?>
        <div class="form-group">
            <label for="auteur">Auteur de l'article:</label>
            <?php if (isset($erreurs) && in_array(Article::AUTEUR_INVALIDE, $erreurs)) echo ' <div class="alert alert-danger fade in"> L\'auteur est invalide.</div><br />'; ?>
            <input type="text" name="auteur" value="<?php if (isset($article)) echo $article->auteur(); ?>" class="form-control" id="auteur">
        </div>
        <div class="form-group">
            <label for="titre">Titre de l'article:</label>
            <?php if (isset($erreurs) && in_array(Article::TITRE_INVALIDE, $erreurs)) echo '<div class="alert alert-danger fade in">Le titre est invalide.</div><br />'; ?>
            <input type="text" name="titre" value="<?php if (isset($article)) echo $article->titre(); ?>" class="form-control" id="titre">
        </div>
        <div class="form-group">
            <label for="contenu">Rédigez votre article:</label>
            <?php if (isset($erreurs) && in_array(Article::CONTENU_INVALIDE, $erreurs)) echo '<div class="alert alert-danger fade in">Le contenu est invalide.</div><br />'; ?>
            <textarea rows="8" cols="60" name="contenu" class="form-control" id="contenu"><?php if (isset($article)) echo $article->contenu(); ?></textarea>
            <p class="help-block">Vous pouvez modifier la taille de la fenêtre.</p>
        </div>
        <?php
        if(isset($article) && !$article->isNew())
        {
            ?>
            <input type="hidden" name="id" class="form-control" value="<?= $article->id() ?>" />
            <button type="submit" value="Modifier"  class="btn btn-primary" name="modifier"><span class="glyphicon glyphicon-ok-sign"></span> Modifier l'article</button>
            <?php
        }
        else
        {
            ?>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span>Enregistrez l'article</button>
            <?php
        }
        ?>
        </fieldset>
    </form>
    </section>

    <div class="row">
        <div class="col-lg-12"> <h2 style="text-align: center" class="jumbotron"> Il y a actuellement <?= $manager->count() ?> article. En voici la liste :</h2></div>
    </div>

    <table class="table">
        <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
        <?php
        foreach ($manager->getList() as $article)
        {
            echo '<tr><td>', $article->auteur(), '</td><td>', $article->titre(), '</td><td>', $article->dateAjout()->format('d/m/Y à H\hi'), '</td><td>',
            ($article->dateAjout() == $article->dateModif() ? '-' : $article->dateModif()->format('d/m/Y à H\hi')), '</td><td><a type="button" class="btn btn-primary" href="?modifier=', $article->id(), '">Modifier</a> | <a type="button" class="btn btn-primary" href="?supprimer=', $article->id(), '">Supprimer</a></td></tr>', "\n";}
        ?>
    </table>
    <footer id="pied" >

        <div class="jumbotron" style="margin-top:25px;">
            <a type="button" class="btn btn-primary" href="accueil.php"> Retournez à l'accueil</a>
        </div>
    </footer>