<?php
require 'class/article.php';
require 'class/articlemanagers.php';
require 'connexion.php';
require 'class/commentaire.php';
require 'class/commentairemanagers.php';
$manager = new ArticleManagers($db);
$managerCom = new Commentairemanagers($db);


if (isset($_POST['auteur']))
{
    $commentaire = new Commentaire(
        [
            'id_billet' => $_GET['id'],
            'auteur' => $_POST['auteur'],
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu']
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

?>

<!DOCTYPE html>
<html>
        <head>
            <title>Article du site</title>
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

    if (isset($message))
    {
        echo '<div class="row"> <div class="col-lg-12">', $message, '<br /></div></div>';
    }

    $article = $manager->getUnique((int) $_GET['id']);

    echo '<p>Par <em>', $article->auteur(), '</em>, le ', $article->dateAjout()->format('d/m/Y à H\hi'), '</p>', "\n",
    '<h2>', $article->titre(), '</h2>', "\n",
    '<p>', nl2br($article->contenu()), '</p>', "\n";

    if ($article->dateAjout() != $article->dateModif())
    {
        echo '<p style="text-align: right;"><small><em>Modifiée le ', $article->dateModif()->format('d/m/Y à H\hi'), '</em></small></p>';
    }
    ?>
            <div class="row"><div class="col-lg-12"><h2> Commentaires : </h2></div></div>
            <?php
            foreach ($managerCom->getListSpe(0, 5, $_GET['id']) as $commentaire) {
                    $contenu = $commentaire->contenu();
                echo '<h4> Par : ',$commentaire->auteur(), ' ', $commentaire->titre(), '</h4>', "\n",
                '<p>', nl2br($contenu), '</p>';
            }
            ?>
            <div class="row">
                <section class="col-sm-8">
                    <form class="well" action="unArticle.php?id=<?php echo $article->id();?>" method="post" >
                        <legend>Si vous souhaitez laisser un commentaire.</legend>
                        <fieldset>
                            <label for="auteur">Votre nom :</label>
                            <?php if (isset($erreurs) && in_array(Article::AUTEUR_INVALIDE, $erreurs)) echo ' <div class="alert alert-danger fade in"> L\'auteur est invalide.</div><br />'; ?>
                            <input type="text" name="auteur" class="form-control" id="auteur">
                            <label for="titre"> Titre du commentaire :</label>
                            <?php if (isset($erreurs) && in_array(Article::TITRE_INVALIDE, $erreurs)) echo '<div class="alert alert-danger fade in">Le titre est invalide.</div><br />'; ?>
                            <input type="text" name="titre" class="form-control" id="titre">
                            <label for="contenu">Votre commentaire :</label>
                            <?php if (isset($erreurs) && in_array(Article::CONTENU_INVALIDE, $erreurs)) echo '<div class="alert alert-danger fade in">Le contenu est invalide.</div><br />'; ?>
                            <textarea id="textarea" name="contenu" id="contenu" class="form-control" rows="4"></textarea>
                            <p class="help-block">Vous pouvez modifier la taille de la fenêtre.</p>
                            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span> Envoyer</button>
                        </fieldset>
                    </form>
                </section>
            </div>
            <?php
            include "footer.php";
            ?>

        </div>
        </body>
</html>