<?php
require '../modeleControllers/Controlleur.php';
require '../modeleControllers/ControlleurAdmin.php';
require '../modele/article.php';
require '../modele/articlemanagers.php';
require '../modele/commentaire.php';
require '../modele/commentairemanagers.php';
require '../modele/Connexion.php';

/*path 1&1 AuthUserFile "/homepages/0/d647464433/htdocs/P3/admin/.htpasswd" */
/* path local C:\wamp64\www\p3\admin\.htpasswd */
/* path ovh : /home/alexandrap/P3/admin/.htpasswd */

$ctrlAdmin = new ControlleurAdmin();
$ctrlAdmin->admin();
?>

