<?php
require '../modele/articlemanagers.php';
require '../modele/article.php';
require '../modele/commentairemanagers.php';
require '../modele/commentaire.php';

require '../modele/connexion.php';
$manager = new ArticleManagers($db);
$managerCom = new Commentairemanagers($db);

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

if (isset($_GET['moderer']))
{
    $commentaire = $managerCom->getUnique((int) $_GET['moderer']);
}


if (isset($_GET['modifier']))
{
    $article = $manager->getUnique((int) $_GET['modifier']);
}

if (isset($_GET['supprimerCom']))
{
    $managerCom->delete((int) $_GET['supprimerCom']);
    $message = '<div class="alert alert-success fade in"> Le commentaire a bien été supprimé.</div>';
}

if (isset($_GET['supprimer']))
{
    $manager->delete((int) $_GET['supprimer']);
    $message = '<div class="alert alert-success fade in"> L article a bien été supprimé !</div>';
}


$listeArticle = $manager->getList((($_GET['p'] - 1) *5), 5);
$listeCom = $managerCom->getList((($_GET['p'] - 1) *5), 5);
$nbArticle = $manager->count();
$nbComModeration = $managerCom->countModeration();
$listeComModeration = $managerCom->getComModeration();

require '../vues/administration.php';
?>

