<?php
require '../modele/article.php';
require '../modele/articlemanagers.php';
require '../modele/connexion.php';
require '../modele/commentaire.php';
require '../modele/commentairemanagers.php';

$manager = new ArticleManagers($db);
$managerCom = new Commentairemanagers($db);

if (isset($_POST['auteur']))
{
    $commentaire = new Commentaire(
        [
            'id_billet' => $_GET['id'],
            'auteur' => $_POST['auteur'],
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu'],
            'moderation' => 0,
            'id_parent' => $_POST['idParent'],
            'depth' => $_POST['depth'],
        ]
    );

    if ($commentaire->isValid()) {
        $managerCom->save($commentaire);

        $message = '<div class="alert alert-success fade in">Le Commentaire a bien été ajouté !</div>';

    }
    else
    {
        $erreurs = $commentaire->erreurs();
    }
}

$reload = '';

if(isset($_GET['moderer']))
{
    $managerCom->update();
    $message ='<div class="alert alert-success fade in"> Merci de nous avoir signalé ce commentaire, notre équipe le supprimera si necéssaire.</div>';
}

if(isset($_GET['id_parent']))
{
    $idParent = (int)$_GET['id_parent'];
    $titreForm = 'Rédigez votre réponse.';
}
else
{
    $idParent = 0;
    $titreForm = 'Si vous souhaitez laisser un commentaire.';
}

if(isset($_GET['depthParent']))
{
    $depthParent = $_GET['depthParent'];
}
else
{
    $depthParent = 0;
}

$article = $manager->getUnique((int) $_GET['id']);
$listeCom= $managerCom->getListSpe(0, 5, $_GET['id'], 0, 1);


require '../vues/unArticle.php';
?>