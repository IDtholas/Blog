<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 27/04/2017
 * Time: 14:59
 */

namespace Controllers;


class ControlleurErreur extends Controlleur
{

    public function erreur()
    {
        require 'vues/erreur.php';
    }

}