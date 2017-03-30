<?php
class Controlleur
{
    protected $manager;
    protected $managerCom;

    public function __construct() {
        $connexion = new Connexion('blog','root','localhost','');
        $this->manager = new ArticleManagers($connexion->db());
        $this->managerCom = new CommentaireManagers($connexion->db());
    }
}