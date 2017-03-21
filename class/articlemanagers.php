<?php

/**
 * Created by PhpStorm.
 * User: DIAZ DE CDORCUERA
 * Date: 20/03/2017
 * Time: 15:26
 */
class articlemanagers
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    protected function add(Article $article)
    {
        $requete = $this->db->prepare('INSERT INTO article(auteur, titre, contenu, dateAjout, dateModif) VALUES(:auteur, :titre, :contenu, NOW(), NOW())');

        $requete->bindValue(':titre', $article->titre());
        $requete->bindValue(':auteur', $article->auteur());
        $requete->bindValue(':contenu', $article->contenu());

        $requete->execute();
    }

    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM article')->fetchColumn();
    }

    public function delete($id)
    {
        $this->db->exec('DELETE FROM article WHERE id = '.(int) $id);
    }

    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM article ORDER BY id DESC';

        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->db->query($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

        $listeArticle = $requete->fetchAll();

        foreach ($listeArticle as $article)
        {
            $article->setDateAjout(new DateTime($article->dateAjout()));
            $article->setDateModif(new DateTime($article->dateModif()));
        }

        $requete->closeCursor();

        return $listeArticle;
    }

    public function getUnique($id)
    {
        $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM article WHERE id = :id');
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');

        $article = $requete->fetch();

        $article->setDateAjout(new DateTime($article->dateAjout()));
        $article->setDateModif(new DateTime($article->dateModif()));

        return $article;
    }

    protected function update(Article $article)
    {
        $requete = $this->db->prepare('UPDATE article SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');

        $requete->bindValue(':titre', $article->titre());
        $requete->bindValue(':auteur', $article->auteur());
        $requete->bindValue(':contenu', $article->contenu());
        $requete->bindValue(':id', $article->id(), PDO::PARAM_INT);

        $requete->execute();
    }
    public function save(Article $article)
    {
        if ($article->isValid())
        {
            $article->isNew() ? $this->add($article) : $this->update($article);
        }
        else
        {
            throw new RuntimeException('L article doit être valide pour être enregistré');
        }
    }
}

?>