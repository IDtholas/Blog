<?php
class Controlleur
{
    protected $manager;
    protected $managerCom;

    public function __construct() {
        $db = new PDO('mysql:host=localhost;dbname=article', 'root', '');
        $this->manager = new ArticleManagers($db);
        $this->managerCom = new CommentaireManagers($db);
    }
}