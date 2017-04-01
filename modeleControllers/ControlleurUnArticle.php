<?php

class ControlleurUnArticle extends Controlleur
{
    public function unArticle()
    {
        if (isset($_POST['auteur']))
        {
            if (preg_match("#<script>#",$_POST['contenu']))
            {
                $message = '<div class="alert alert-danger fade in"> Protection injection javascript activée!</div>';
            }
            else {
                $commentaire = new Commentaire(
                    [
                        'id_billet' => $_GET['id'],
                        'auteur' => $_POST['auteur'],
                        'titre' => $_POST['titre'],
                        'contenu' => htmlspecialchars($_POST['contenu']),
                        'moderation' => 0,
                        'id_parent' => $_POST['idParent'],
                        'depth' => $_POST['depth'],
                    ]
                );

                if ($commentaire->isValid()) {
                    $this->managerCom->save($commentaire);

                    $message = '<div class="alert alert-success fade in">Le Commentaire a bien été ajouté !</div>';

                } else {
                    $erreurs = $commentaire->erreurs();
                }
            }
        }

        if(isset($_GET['moderer']))
        {
            $this->managerCom->update();
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

        $article = $this->manager->getUnique((int) $_GET['id']);
        $listeCom= $this->managerCom->getListSpe(0, 5, $_GET['id'], 0, 1);


        require 'vues/unArticle.php';
    }
}