<?php

class mailer
{
 private $nom;
 private $titre;
 private $email;
 private $message;
 private $erreurs=[];

 const AUTEUR_INVALIDE = 1;
 const TITRE_INVALIDE = 2;
 const CONTENU_INVALIDE = 3;
 const EMAIL_INVALIDE = 4;

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


    //SETTERS


    public function setNom($nom)
    {
        if (!is_string($nom) || empty($nom))
        {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        }
        else
        {
            $this->nom = $nom;
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

    public function setEmail($email)
    {
        if (!is_string($email) || empty($email))
        {
            $this->erreurs[] = self::EMAIL_INVALIDE;
        }
        else
        {
            $this->email = $email;
        }
    }

    public function setMessage($message)
    {
        if (!is_string($message) || empty($message))
        {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        }
        else
        {
            $this->message = $message;
        }
    }

    //GETTERS

    public function nom()
    {
        return $this->nom;
    }

    public function titre()
    {
        return $this->titre;
    }

    public function email()
    {
        return $this->email;
    }

    public function message()
    {
        return $this->message;
    }


    public function erreurs()
    {
        return $this->erreurs;
    }

    public function isValid()
    {
        return !(empty($this->nom) || empty($this->titre) || empty($this->email) || empty($this->message));
    }

    //Fonction envoyant le mail
    public function mail()
    {
        $name = $this->nom;
        $email_address = $this->email;
        $titre = $this->titre;
        $message = $this->message;


        $to = 'alexandre.drabczuk@hotmail.fr';
        $email_subject = "Contact du blog de Jean forteroche:  $name";
        $email_body = "Vous avez reçu un message de votre siteweb.</br>" . "En voici les détails:\n</br>Nom de l'expediteur: $name\n</br>Email: $email_address\n</br>Titre: $titre\n</br>Message:\n$message";
        $headers = "From: blog-ecrivain.alexandre-drabczuk.fr\n";
        $headers .= "Reply-To: postmaster@blogForteroche.com\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n";
        $headers .= "Content-type: text/html; charset=utf-8\n";
        $headers .= "Reply-To: $email_address";
        mail($to, $email_subject, $email_body, $headers);

    }

}