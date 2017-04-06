<?php

namespace Controllers;

class RooterAdmin
{
    private $ctrlAdmin;

    public function __construct()
    {
        $this->ctrlAdmin = New ControlleurAdmin();
    }

    public function rooterRequete()
    {
        $this->ctrlAdmin->admin();
    }
}