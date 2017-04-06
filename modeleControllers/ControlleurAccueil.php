<?php

namespace Controllers;

class ControlleurAccueil extends Controlleur
{


    // rien de dynamique sur cette page
    public function accueil()
    {
        require 'vues/accueil.php';
    }
}