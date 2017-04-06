<?php

namespace Controllers;

use Modele\Article;

class ControlleurAdmin extends Controlleur
{
    public function admin()
    {
        //si un article a été posté.
        if (isset($_POST['auteur']))
        {
            if (preg_match("#<script>#",$_POST['auteur']) || preg_match("#<script>#",$_POST['titre']) )
            {
                $message = '<div class="alert alert-danger fade in text-center"> Protection injection javascript activée!</div>';
            }
            else {
                $article = new Article(
                    [
                        'auteur' => htmlspecialchars($_POST['auteur']),
                        'titre' => htmlspecialchars($_POST['titre']),
                        'contenu' => $_POST['contenu']
                    ]
                );

                //si c'est une modification, on set l'id de l'article à modifier
                if (isset($_POST['id'])) {
                    $article->setId($_POST['id']);
                }

                //si les champs sont remplis, on le save, et display du message correspondant
                if ($article->isValid()) {
                    $this->manager->save($article);

                    $message = $article->isNew() ? '<div class="alert alert-success fade in text-center">L article a bien été ajouté !</div>' : ' <div class="alert alert-success fade in text-center">L article a bien été modifié ! </div>';
                } //sinon, erreur
                else {
                    $erreurs = $article->erreurs();
                }
            }
        }

        //Récupération du commentaire à modérer
        if (isset($_GET['moderer']))
        {
            $commentaire = $this->managerCom->getUnique((int) $_GET['moderer']);
        }

        //si on choisit de modifier un article, on le récupère par son id
        if (isset($_GET['modifier']))
        {
            $article = $this->manager->getUnique((int) $_GET['modifier']);
        }

        // On récupère l'id du commentaire à supprimer
        if (isset($_GET['supprimerCom']))
        {
            $this->managerCom->delete((int) $_GET['supprimerCom']);
            $message = '<div class="alert alert-success fade in text-center"> Le commentaire a bien été supprimé.</div>';
        }

        // on enlève le signalement à un commentaire
        if (isset($_GET['deModerer']))
        {
            $this->managerCom->deModerer();
            $message = '<div class="alert alert-success fade in text-center"> Le commentaire est de nouveau valide.</div>';
        }

        // on supprime le commentaire signalé
        if (isset($_GET['supprimer']))
        {
            $this->manager->delete((int) $_GET['supprimer']);
            $this->managerCom->supprimerComArticle((int) $_GET['supprimer']);
            $message = '<div class="alert alert-success fade in text-center"> L article a bien été supprimé !</div>';
        }

        if (isset($erreurs) && in_array(Article::AUTEUR_INVALIDE, $erreurs))
        {
            $messageAuteurArticle = ' <div class="alert alert-danger fade in"> L\'auteur est invalide.</div><br />';
        }
        else
        {
            $messageAuteurArticle ='';
        }

        if (isset($erreurs) && in_array(Article::TITRE_INVALIDE, $erreurs))
        {
            $messageTitreArticle = ' <div class="alert alert-danger fade in"> Le titre est invalide.</div><br />';
        }
        else
        {
            $messageTitreArticle ='';
        }

        if (isset($erreurs) && in_array(Article::CONTENU_INVALIDE, $erreurs))
        {
            $messageContenuArticle = ' <div class="alert alert-danger fade in"> Le contenu est invalide.</div><br />';
        }
        else
        {
            $messageContenuArticle ='';
        }

        $listeArticle = $this->manager->getList((($_GET['p'] - 1) *5), 5);
        $listeCom = $this->managerCom->getList((($_GET['p'] - 1) *5), 5);
        $nbArticle = $this->manager->count();
        $nbComModeration = $this->managerCom->countModeration();
        $listeComModeration = $this->managerCom->getComModeration();

        require '../vues/administration.php';

    }
}