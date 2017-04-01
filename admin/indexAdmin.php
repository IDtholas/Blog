<?php
require '../modeleControllers/Controlleur.php';
require '../modeleControllers/ControlleurAdmin.php';
require '../modele/article.php';
require '../modele/articlemanagers.php';
require '../modele/commentaire.php';
require '../modele/commentairemanagers.php';
require '../modele/Connexion.php';
require '../modeleControllers/RooterAdmin.php';

$rooter= New RooterAdmin();
$rooter->rooterRequete();