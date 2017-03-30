<?php

class ControlleurLesArticles extends Controlleur
{
    public function lesArticles()
    {
        $nbArticle = $this->manager->count();
        $listeArticle = $this->manager->getList((($_GET['p'] - 1) *5), 5);
        require 'vues/lesArticles.php';
    }
}
?>