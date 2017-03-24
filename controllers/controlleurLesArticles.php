<?php
require '../modele/article.php';
require '../modele/articlemanagers.php';
require '../modele/connexion.php';
$manager = new ArticleManagers($db);

$nbArticle = $manager->count();
$listeArticle = $manager->getList((($_GET['p'] - 1) *5), 5);

require '../vues/lesArticles.php';
?>
