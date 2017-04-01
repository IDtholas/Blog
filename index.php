<?php
require 'modeleControllers/Controlleur.php';
require 'modeleControllers/ControlleurAccueil.php';
require 'modele/Connexion.php';
require 'modele/article.php';
require 'modele/articlemanagers.php';
require 'modele/commentaire.php';
require 'modele/commentairemanagers.php';
require 'modeleControllers/ControlleurLesArticles.php';
require 'modeleControllers/ControlleurUnArticle.php';
require 'modeleControllers/ControlleurAdmin.php';
require 'modeleControllers/ControlleurContact.php';
require 'modeleControllers/ControlleurAPropos.php';
require 'modeleControllers/Rooter.php';
require 'modele/Mailer.php';

$rooter= New Rooter();
$rooter->rooterRequete();
?>