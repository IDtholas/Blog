<?php

class ControlleurAdmin extends Controlleur
{
    public function admin()
    {
        //si un article a été posté.
        if (isset($_POST['auteur']))
        {
            $article = new Article(
                [
                    'auteur' => $_POST['auteur'],
                    'titre' => $_POST['titre'],
                    'contenu' => $_POST['contenu']
                ]
            );

            //si c'est une modification, on set l'id de l'article à modifier
            if (isset($_POST['id']))
            {
                $article->setId($_POST['id']);
            }

            //si les champs sont remplis, on le save, et display du message correspondant
            if ($article->isValid())
            {
                $this->manager->save($article);

                $message = $article->isNew() ? '<div class="alert alert-success fade in text-center">L article a bien été ajouté !</div>' : ' <div class="alert alert-success fade in text-center">L article a bien été modifié ! </div>';
            }
            //sinon, erreur
            else
            {
                $erreurs = $article->erreurs();
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


        $listeArticle = $this->manager->getList((($_GET['p'] - 1) *5), 5);
        $listeCom = $this->managerCom->getList((($_GET['p'] - 1) *5), 5);
        $nbArticle = $this->manager->count();
        $nbComModeration = $this->managerCom->countModeration();
        $listeComModeration = $this->managerCom->getComModeration();

        require '../vues/administration.php';

    }
}