<?php

class Rooter
{
    private $ctrlAccueil;
    private $ctrlUnArticle;
    private $ctrlAdmin;
    private $ctrlLesArticles;

    public function __construct()
    {
        $this->ctrlAccueil= New ControlleurAccueil();
        $this->ctrlLesArticles= New ControlleurLesArticles();
        $this->ctrlUnArticle = New ControlleurUnArticle();
        $this->ctrlAdmin = New ControlleurAdmin();
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

        if($page === 'admin')
        {
            header('Location: admin/controlleurAdministration.php?p=1');
            exit();
        }

    }
}