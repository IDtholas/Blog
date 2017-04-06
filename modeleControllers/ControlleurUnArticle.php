<?php

namespace Controllers;

use Modele\Commentaire;

class ControlleurUnArticle extends Controlleur
{
    public function unArticle()
    {
        //si le formulaire est soumis
        if (isset($_POST['auteur']))
        {
            //protection injection js
            if (preg_match("#<script>#",$_POST['contenu']) || preg_match("#<script>#",$_POST['auteur']) || preg_match("#<script>#",$_POST['titre']) )
            {
                $message = '<div class="alert alert-danger fade in text-center"> Protection injection javascript activée!</div>';
            }
            else {
                $commentaire = new Commentaire(
                    [
                        'id_billet' => $_GET['id'],
                        'auteur' => htmlspecialchars($_POST['auteur']),
                        'titre' => htmlspecialchars($_POST['titre']),
                        'contenu' => htmlspecialchars($_POST['contenu']),
                        'moderation' => 0,
                        'id_parent' => $_POST['idParent'],
                        'depth' => $_POST['depth'],
                    ]
                );

                // s'il est valide, on l'ajoute à la bdd
                if ($commentaire->isValid()) {
                    $this->managerCom->save($commentaire);

                    $message = '<div class="alert alert-success fade in text-center">Le Commentaire a bien été ajouté !</div>';

                } else {
                    $erreurs = $commentaire->erreurs();
                }
            }
        }

        //si le commentaire est signalé, on change la valeur d'un BOOL et on display un message
        if(isset($_GET['moderer']))
        {
            $this->managerCom->update();
            $message ='<div class="alert alert-success fade in text-center"> Merci de nous avoir signalé ce commentaire, notre équipe le supprimera si necéssaire.</div>';
        }

        // on regarde si le commentaire est une réponse
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

        // on regarde le niveau de la réponse
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