<html>
        <head>
            <title>Article du site</title>
            <meta charset="utf-8" />
            <link href="../css/bootstrap.css" rel="stylesheet">
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

    echo '<p>Par <em>', $article->auteur(), '</em>, le ', $article->dateAjout()->format('d/m/Y à H\hi'), '</p>', "\n",
    '<h2>', $article->titre(), '</h2>', "\n",
    '<p>', nl2br($article->contenu()), '</p>', "\n";

    if ($article->dateAjout() != $article->dateModif())
    {
        echo '<p style="text-align: right;"><small><em>Modifiée le ', $article->dateModif()->format('d/m/Y à H\hi'), '</em></small></p>';
    }
    ?>
            <div class="row"><div class="col-lg-12"><h2> Commentaires : </h2></div></div>

            <div class="row">
                <section class="col-sm-8">
                    <form class="well" action="controlleurUnArticle.php?id=<?php echo $article->id()?>" method="post" >
                        <legend> <?php echo $titreForm; ?> </legend>
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
                            <input type="hidden" name="depth" value="<?= $depthParent + 1 ?>" />
                            <input type="hidden" name="idParent" value="<?= $idParent ?>" />
                            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span> Envoyer</button>
                        </fieldset>
                    </form>
                </section>
            </div>


            <?php

            foreach ($listeCom as $commentaire) {
                    $contenu = $commentaire->contenu();
                echo '<h4> Par : ',$commentaire->auteur(), ' ', $commentaire->titre(), '</h4>', "\n",
                '<p>', nl2br($contenu), '</p><a class="btn btn-primary" href="controlleurUnArticle.php?id=',$article->id(),'&moderer=1"> Signalez un commentaire inapproprié. </a> <a class="btn btn-primary" href="controlleurUnArticle.php?id=', $article->id(),'&id_parent=', $commentaire->id(),'&depthParent=', $commentaire->depth(),'">Répondre</a>';

                foreach ( $managerCom->getListSpe(0,5, $_GET['id'], $commentaire->id(), 2) as $reponse1)
                {
                    $contenu = $reponse1->contenu();
                    echo '<h4> Par : ',$reponse1->auteur(), ' ', $reponse1->titre(), '</h4>', "\n",
                    '<p>', nl2br($contenu), '</p><a class="btn btn-primary" href="controlleurUnArticle.php?id=', $article->id(),'&id_parent=', $commentaire->id(),'&depthParent=', $reponse1->depth(),'">Répondre</a>';

                    foreach ( $managerCom->getListSpe(0,5, $_GET['id'], $commentaire->id(), 3) as $reponse2)
                    {
                        $contenu = $reponse2->contenu();
                        echo '<h4> Par : ',$reponse2->auteur(), ' ', $reponse2->titre(), '</h4>', "\n",
                        '<p>', nl2br($contenu), '</p><a class="btn btn-primary" href="controlleurUnArticle.php?id=', $article->id(),'&id_parent=', $commentaire->id(),'&depthParent=', $reponse2->depth(),'">Répondre</a>';

                        foreach ( $managerCom->getListSpe(0,5, $_GET['id'], $commentaire->id(), 4) as $reponse3)
                        {
                            $contenu = $reponse3->contenu();
                            echo '<h4> Par : ',$reponse3->auteur(), ' ', $reponse3->titre(), '</h4>', "\n",
                            '<p>', nl2br($contenu), '</p><a class="btn btn-primary" href="controlleurUnArticle.php?id=', $article->id(),'&id_parent=', $commentaire->id(),'&depthParent=', $reponse3->depth(),'">C est fini c est tout</a>';

                        }
                    }
                }
            }
            ?>
            <?php
            include "footer.php";
            ?>

        </div>
        </body>
</html>