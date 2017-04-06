<?php

namespace Controllers;

class ControlleurLesArticles extends Controlleur
{
    // on compte les articles pour déterminer la pagination, et on les listes par 5.
    public function lesArticles()
    {
        $nbArticle = $this->manager->count();
        $listeArticle = $this->manager->getList((($_GET['p'] - 1) *5), 5);
        require 'vues/lesArticles.php';
    }
}