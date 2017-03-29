<?php

class ControlleurAdmin extends Controlleur
{
    public function admin()
    {
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
                $this->manager->save($article);

                $message = $article->isNew() ? '<div class="alert alert-success fade in">L article a bien été ajouté !</div>' : ' <div class="alert alert-success fade in">L article a bien été modifié ! </div>';
            }
            else
            {
                $erreurs = $article->erreurs();
            }
        }

        if (isset($_GET['moderer']))
        {
            $commentaire = $this->managerCom->getUnique((int) $_GET['moderer']);
        }


        if (isset($_GET['modifier']))
        {
            $article = $this->manager->getUnique((int) $_GET['modifier']);
        }

        if (isset($_GET['supprimerCom']))
        {
            $this->managerCom->delete((int) $_GET['supprimerCom']);
            $message = '<div class="alert alert-success fade in"> Le commentaire a bien été supprimé.</div>';
        }

        if (isset($_GET['supprimer']))
        {
            $this->manager->delete((int) $_GET['supprimer']);
            $message = '<div class="alert alert-success fade in"> L article a bien été supprimé !</div>';
        }


        $listeArticle = $this->manager->getList((($_GET['p'] - 1) *5), 5);
        $listeCom = $this->managerCom->getList((($_GET['p'] - 1) *5), 5);
        $nbArticle = $this->manager->count();
        $nbComModeration = $this->managerCom->countModeration();
        $listeComModeration = $this->managerCom->getComModeration();

        require '../vues/administration.php';

    }
}
?>