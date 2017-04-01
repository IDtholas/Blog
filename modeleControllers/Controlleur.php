<?php
class Controlleur
{
    protected $manager;
    protected $managerCom;
    protected $connexion;

    public function __construct() {
        $this->connexion = new Connexion();
        $this->manager = new ArticleManagers($this->connexion->db());
        $this->managerCom = new CommentaireManagers($this->connexion->db());
    }
}