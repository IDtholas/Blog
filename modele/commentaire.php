<?php

/**
 * Created by PhpStorm.
 * User: DIAZ DE CDORCUERA
 * Date: 20/03/2017
 * Time: 15:26
 */
class Commentaire
{
    protected $erreurs = [];
    protected $id;
    protected $id_billet;
    protected $id_parent;
    protected $depth;
    protected $auteur;
    protected $titre;
    protected $moderation = 0;
    protected $contenu;
    protected $dateAjout;

    const AUTEUR_INVALIDE = 1;
    const TITRE_INVALIDE = 2;
    const CONTENU_INVALIDE = 3;

    public function __construct($valeurs = [])
    {
        if (!empty($valeurs))
        {
            $this->hydrate($valeurs);
        }
    }

    public function hydrate($donnees)
    {
        foreach ($donnees as $attribut => $valeur)
        {
            $methode = 'set'.ucfirst($attribut);

            if (is_callable([$this, $methode]))
            {
                $this->$methode($valeur);
            }
        }
    }
    public function isValid()
    {
        return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }


    public function setId_billet($idbillet)
    {
        $idbillet = $_GET['id'];
        $this->id_billet = (int) $idbillet;
    }


    public function setAuteur($auteur)
    {
        if (!is_string($auteur) || empty($auteur))
        {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        }
        else
        {
            $this->auteur = $auteur;
        }
    }

    public function setTitre($titre)
    {
        if (!is_string($titre) || empty($titre))
        {
            $this->erreurs[] = self::TITRE_INVALIDE;
        }
        else
        {
            $this->titre = $titre;
        }
    }

    public function setContenu($contenu)
    {
        if (!is_string($contenu) || empty($contenu))
        {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        }
        else
        {
            $this->contenu = $contenu;
        }
    }

    public function setDateAjout(DateTime $dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }

    public function setModeration($moderation)
    {
        $this->moderation = $moderation;
    }

    public function setId_parent($id_parent)
    {
        $this->id_parent = $id_parent;
    }

    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function moderation()
    {
        return $this->moderation;
    }

    public function id_parent()
    {
        return $this->id_parent;
    }

    public function depth()
    {
        return $this->depth;
    }

    public function erreurs()
    {
        return $this->erreurs;
    }

    public function id()
    {
        return $this->id;
    }

    public function auteur()
    {
        return $this->auteur;
    }

    public function id_billet()
    {
        return $this->id_billet;
    }
    public function titre()
    {
        return $this->titre;
    }

    public function contenu()
    {
        return $this->contenu;
    }

    public function dateAjout()
    {
        return $this->dateAjout;
    }

}

?>
