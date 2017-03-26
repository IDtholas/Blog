<?php
require '../modele/article.php';
require '../modele/articlemanagers.php';
require '../modele/connexion.php';
require '../modele/commentaire.php';
require '../modele/commentairemanagers.php';

$manager = new ArticleManagers($db);
$managerCom = new Commentairemanagers($db);


$article = $manager->getUnique((int) $_GET['id']);
$listeCom= $managerCom->getListSpe(0, 5, $_GET['id'], 0, 0);

if (isset($_POST['auteur']))
{
    $commentaire = new Commentaire(
        [
            'id_billet' => $_GET['id'],
            'auteur' => $_POST['auteur'],
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu'],
            'moderation' => 0,
            'id_parent' => 0,
            'depth' =>0,
        ]
    );

    if ($commentaire->isValid())
    {
        $managerCom->save($commentaire);

        $message = '<div class="alert alert-success fade in">Le Commentaire a bien été ajouté !</div>';
    }
    else
    {
        $erreurs = $commentaire->erreurs();
    }
}

require '../vues/unArticle.php';
?>