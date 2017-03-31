<?php

class mailer
{
 private $name;
 private $email;
 private $message;
 private $phone;

 const TO = 'alexandre.drabczuk@gmail.com';
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

    public function mail()
    {

    }

}
?>