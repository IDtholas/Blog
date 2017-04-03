<?php

class ControlleurContact
{
    public function contact()
    {
        //si le formulaire a été soumis, on créé l'objet, on verifie sa validité, et on envoie le mail
        if (isset($_POST['nom'])) {
            $mail = new Mailer(
                [
                    'nom' => strip_tags(htmlspecialchars($_POST['nom'])),
                    'email' => strip_tags(htmlspecialchars($_POST['email'])),
                    'titre' => strip_tags(htmlspecialchars($_POST['titre'])),
                    'message' => strip_tags(htmlspecialchars($_POST['message'])),
                ]
            );

            if ($mail->isValid()) {
                $mail->mail();

                $message = '<div class="alert alert-success fade in text-center">Le message a bien été envoyé !</div>';

            } else {
                $erreurs = $mail->erreurs();
            }
        }

        require 'vues/contact.php';

    }
}