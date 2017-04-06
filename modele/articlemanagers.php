<?php

namespace Modele;

class ArticleManagers
{
    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }


    //ajouter un article
    protected function add(Article $article)
    {
        $requete = $this->db->prepare('INSERT INTO article(auteur, titre, contenu, dateAjout, dateModif) VALUES(:auteur, :titre, :contenu, NOW(), NOW())');

        $requete->bindValue(':titre', $article->titre());
        $requete->bindValue(':auteur', $article->auteur());
        $requete->bindValue(':contenu', $article->contenu());

        $requete->execute();
    }

    //compte les articles présents en db.
    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM article')->fetchColumn();
    }

    // supprimer un article
    public function delete($id)
    {
        $this->db->exec('DELETE FROM article WHERE id = '.(int) $id);
    }


    // récupérer une liste d'article, param1 = début de la sélection ;  param2= nombre d'articles sélectionnés
    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM article ORDER BY id DESC';

        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->db->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, __NAMESPACE__.'\\Article');

        $listeArticle = $requete->fetchAll();

        foreach ($listeArticle as $article)
        {
            $article->setDateAjout(new \DateTime($article->dateAjout()));
            $article->setDateModif(new \DateTime($article->dateModif()));
        }

        $requete->closeCursor();

        return $listeArticle;
    }

    //récupérer un article via son $id
    public function getUnique($id)
    {
        $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM article WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, __NAMESPACE__.'\\Article');

        $article = $requete->fetch();

        $article->setDateAjout(new \DateTime($article->dateAjout()));
        $article->setDateModif(new \DateTime($article->dateModif()));

        return $article;
    }


    //update de l'article en db quand modifié.
    protected function update(Article $article)
    {
        $requete = $this->db->prepare('UPDATE article SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');

        $requete->bindValue(':titre', $article->titre());
        $requete->bindValue(':auteur', $article->auteur());
        $requete->bindValue(':contenu', $article->contenu());
        $requete->bindValue(':id', $article->id(), \PDO::PARAM_INT);

        $requete->execute();
    }

    //ajoute ou update l'article selon la valeur du BOOL de isnew()
    public function save(Article $article)
    {
        if ($article->isValid())
        {
            $article->isNew() ? $this->add($article) : $this->update($article);
        }
        else
        {
            throw new \RuntimeException('L article doit être valide pour être enregistrée');
        }
    }
}