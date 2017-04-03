<?php

class Rooter
{
    private $ctrlAccueil;
    private $ctrlUnArticle;
    private $ctrlAdmin;
    private $ctrlLesArticles;
    private $ctrlApropos;
    private $ctrlContact;

    public function __construct()
    {
        $this->ctrlAccueil= New ControlleurAccueil();
        $this->ctrlLesArticles= New ControlleurLesArticles();
        $this->ctrlUnArticle = New ControlleurUnArticle();
        $this->ctrlApropos = New ControlleurAPropos();
        $this->ctrlAdmin = New ControlleurAdmin();
        $this->ctrlContact = New ControlleurContact();
    }

    public function rooterRequete()
    {
        if(isset($_GET['action']))
        {
            $page = $_GET['action'];
        }
        else
        {
            $page = 'accueil';
        }

        if($page === 'accueil')
        {
            $this->ctrlAccueil->accueil();
        }

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
}