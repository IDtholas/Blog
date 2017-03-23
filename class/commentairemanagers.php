<?php

/**
 * Created by PhpStorm.
 * User: DIAZ DE CDORCUERA
 * Date: 20/03/2017
 * Time: 15:27
 */
class Commentairemanagers
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    protected function add(Commentaire $commentaire)
    {
        $requete = $this->db->prepare('INSERT INTO commentaire(id_billet, auteur, titre, contenu, dateAjout, dateModif) VALUES(:id_billet, :auteur, :titre, :contenu, NOW(), NOW())');

        $requete->bindValue(':id_billet', $commentaire->id_billet());
        $requete->bindValue(':titre', $commentaire->titre());
        $requete->bindValue(':auteur', $commentaire->auteur());
        $requete->bindValue(':contenu', $commentaire->contenu());

        $requete->execute();
    }

    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM commentaire')->fetchColumn();
    }

    public function delete($id)
    {
        $this->db->exec('DELETE FROM commentaire WHERE id = '.(int) $id);
    }

    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM commentaire ORDER BY id DESC';

        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->db->query($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');

        $listeCommentaire = $requete->fetchAll();

        foreach ($listeCommentaire as $commentaire)
        {
            $commentaire->setDateAjout(new DateTime($commentaire->dateAjout()));
            $commentaire->setDateModif(new DateTime($commentaire->dateModif()));
        }

        $requete->closeCursor();

        return $listeCommentaire;
    }

    public function getListSpe($debut = -1, $limite = -1, $id)
    {
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM commentaire WHERE id_billet = :id ORDER BY id DESC';

        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->db->prepare($sql);
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Commentaire');

        $listeCommentaire = $requete->fetchAll();

        foreach ($listeCommentaire as $commentaire)
        {
            $commentaire->setDateAjout(new DateTime($commentaire->dateAjout()));
            $commentaire->setDateModif(new DateTime($commentaire->dateModif()));
        }

        $requete->closeCursor();

        return $listeCommentaire;
    }
    public function getUnique($id)
    {
        $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM commentaire WHERE id = :id');
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');

        $article = $requete->fetch();

        $commentaire->setDateAjout(new DateTime($commentaire->dateAjout()));
        $commentaire->setDateModif(new DateTime($commentaire->dateModif()));

        return $commentaire;
    }

    protected function update(Commentaire $commentaire)
    {
        $requete = $this->db->prepare('UPDATE commentaire SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');

        $requete->bindValue(':titre', $article->titre());
        $requete->bindValue(':auteur', $article->auteur());
        $requete->bindValue(':contenu', $article->contenu());
        $requete->bindValue(':id', $article->id(), PDO::PARAM_INT);

        $requete->execute();
    }

    public function save(Commentaire $commentaire)
    {
        if ($commentaire->isValid())
        {
            $commentaire->isNew() ? $this->add($commentaire) : $this->update($commentaire);
        }
        else
        {
            throw new RuntimeException('Le commentaire doit être valide pour être enregistré');
        }
    }
}
?>
