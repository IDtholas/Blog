<?php

namespace Controllers;

class Rooter
{
    private $ctrlAccueil;
    private $ctrlUnArticle;
    private $ctrlAdmin;
    private $ctrlLesArticles;
    private $ctrlApropos;
    private $ctrlContact;
    private $ctrlErreur;
    private $urlPossible = [];

    public function __construct()
    {
        $this->ctrlAccueil= New ControlleurAccueil();
        $this->ctrlLesArticles= New ControlleurLesArticles();
        $this->ctrlUnArticle = New ControlleurUnArticle();
        $this->ctrlApropos = New ControlleurAPropos();
        $this->ctrlAdmin = New ControlleurAdmin();
        $this->ctrlContact = New ControlleurContact();
        $this->ctrlErreur = New ControlleurErreur();
        $this->urlPossible = ['accueil', 'lesArticles', 'unArticle', 'aPropos', 'contact'];
    }

    public function rooterRequete()
    {

        if(isset($_GET['action']))
        {
            $page = $_GET['action'];
            if(in_array($_GET['action'], $this->urlPossible))
            {
                if($page === 'lesArticles')
                {
                    $this->ctrlLesArticles->lesArticles();
                }

                if($page ==='unArticle')
                {
                    $this->ctrlUnArticle->unArticle();
                }

                if($page ==='aPropos')
                {
                    $this->ctrlApropos->aPropos();
                }

                if($page ==='contact')
                {
                    $this->ctrlContact->contact();
                }

            }
            else
            {
               $this->ctrlErreur->erreur();
            }
        }
        else
        {
            $page = 'accueil';
        }

        if($page === 'accueil')
        {
            $this->ctrlAccueil->accueil();
        }
    }

}