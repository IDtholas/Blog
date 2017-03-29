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
        $requete = $this->db->prepare('INSERT INTO commentaire(id_billet, auteur, titre, contenu, dateAjout, moderation, id_parent, depth) VALUES(:id_billet, :auteur, :titre, :contenu, NOW(),:moderation, :id_parent, :depth)');

        $requete->bindValue(':id_billet', $commentaire->id_billet());
        $requete->bindValue(':titre', $commentaire->titre());
        $requete->bindValue(':auteur', $commentaire->auteur());
        $requete->bindValue(':contenu', $commentaire->contenu());
        $requete->bindValue('moderation', 0);
        $requete->bindValue(':id_parent', $commentaire->id_parent());
        $requete->bindValue('depth', $commentaire->depth());

        $requete->execute();
    }

    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM commentaire')->fetchColumn();
    }

    public function countModeration()
    {
     return $this->db->query('SELECT COUNT(*) FROM commentaire WHERE moderation = 1') ->fetchColumn();
    }

    public function delete($id)
    {
        $this->db->exec('DELETE FROM commentaire WHERE id = '.(int) $id);
    }

    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, moderation, id_parent, depth FROM commentaire ORDER BY id DESC';

        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->db->query($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Commentaire');

        $listeCommentaire = $requete->fetchAll();

        foreach ($listeCommentaire as $commentaire)
        {
            $commentaire->setDateAjout(new DateTime($commentaire->dateAjout()));
        }

        $requete->closeCursor();

        return $listeCommentaire;
    }

    public function getListSpe($debut = -1, $limite = -1, $id_billet, $id_parent, $depth)
    {
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, moderation, id_parent, depth FROM commentaire WHERE id_billet = :id_billet AND id_parent = :id_parent AND depth = :depth ORDER BY id DESC';

        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->db->prepare($sql);
        $requete->bindValue(':id_billet', $id_billet, PDO::PARAM_INT);
        $requete->bindValue(':id_parent', $id_parent, PDO::PARAM_INT);
        $requete->bindValue(':depth', $depth, PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Commentaire');

        $listeCommentaire = $requete->fetchAll();

        foreach ($listeCommentaire as $commentaire)
        {
            $commentaire->setDateAjout(new DateTime($commentaire->dateAjout()));
        }

        $requete->closeCursor();

        return $listeCommentaire;
    }
    public function getUnique($id)
    {
        $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout, moderation, id_billet, id_parent, depth FROM commentaire WHERE id = :id');
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Commentaire');

        $commentaire = $requete->fetch();

        $commentaire->setDateAjout(new DateTime($commentaire->dateAjout()));

        return $commentaire;
    }

    public function save(Commentaire $commentaire)
    {
        if ($commentaire->isValid())
        {
            $this->add($commentaire);
        }
        else
        {
            throw new RuntimeException('Le commentaire doit être valide pour être enregistré');
        }
    }

    public function update()
    {
        $requete = $this->db->prepare('UPDATE commentaire SET moderation = :moderation WHERE id = :id');

        $requete->bindValue(':moderation', 1, PDO::PARAM_INT);
        $requete->bindValue(':id', $_GET['moderer'], PDO::PARAM_INT);

        $requete->execute();
    }

    public function getComModeration()
    {
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, id_billet, id_parent, depth, moderation FROM commentaire WHERE moderation = :moderation ORDER BY id DESC';
        $requete = $this->db->prepare($sql);
        $requete->bindValue('moderation', 1, PDO::PARAM_INT);

        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Commentaire');

        $listeComModeration = $requete->fetchAll();

        foreach ($listeComModeration as $commentaire)
        {
            $commentaire->setDateAjout(new DateTime($commentaire->dateAjout()));
        }

        $requete->closeCursor();

        return $listeComModeration;

    }
}
?>
