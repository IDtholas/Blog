<?php
class Controlleur
{
    protected $manager;
    protected $managerCom;

    public function __construct() {
        $db = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
        $this->manager = new ArticleManagers($db);
        $this->managerCom = new CommentaireManagers($db);
    }
}