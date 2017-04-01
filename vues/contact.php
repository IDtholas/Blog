<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog de Jean Forteroche">
    <meta name="author" content=" Jean Forteroche">
    <title>Page contact du site</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="index.php">Blog de Jean Forteroche</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <a href="index.php?action=lesArticles&p=1">Les articles</a>
                </li>
                <li>
                    <a href="index.php?action=aPropos">A propos de moi</a>
                </li>
                <li>
                    <a href="index.php?action=contact">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('images/contactBackground.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Blog de Jean Forteroche</h1>
                    <hr class="small">
                    <span class="subheading">Blog d'un écrivain fantaisiste.</span>
                </div>
            </div>
        </div>
    </div>
</header>

<?php
if (isset($message))
{
    echo '<div class="row"> <div class="col-lg-12 text-center">', $message, '<br /></div></div>';
}
?>
<?php

/*
if(isset($_POST['nom'])) {
    $name = strip_tags(htmlspecialchars($_POST['nom']));
    $email_address = strip_tags(htmlspecialchars($_POST['email']));
    $titre = strip_tags(htmlspecialchars($_POST['titre']));
    $message = strip_tags(htmlspecialchars($_POST['message']));


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
}*/
?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <p>Si vous souhaitez me contacter pour n'importe quelle raison, vous pouvez le faire via le formulaire ci-dessous : </p>
                <form method="post" action="index.php?action=contact" name="sentMessage" id="contactForm">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="auteur">Nom</label>
                            <?php if (isset($erreurs) && in_array(Mailer::AUTEUR_INVALIDE, $erreurs)) echo ' <div class="alert alert-danger fade in"> L\'auteur est invalide.</div><br />'; ?>
                            <input type="text" name="nom" placeholder="Nom" class="form-control" id="nom">
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="email">Email</label>
                            <?php if (isset($erreurs) && in_array(Mailer::EMAIL_INVALIDE, $erreurs)) echo ' <div class="alert alert-danger fade in"> L\'email est invalide.</div><br />'; ?>
                            <input type="text" name="email" placeholder="Adresse email" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="email">Titre du message</label>
                            <?php if (isset($erreurs) && in_array(Mailer::TITRE_INVALIDE, $erreurs)) echo ' <div class="alert alert-danger fade in"> Le titre est invalide.</div><br />'; ?>
                            <input type="text" name="titre" placeholder="Titre du message" class="form-control" id="titre">
                        </div>
                    </div>
                    <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                    <label for="message">Message</label>
                        <?php if (isset($erreurs) && in_array(Mailer::CONTENU_INVALIDE, $erreurs)) echo '<div class="alert alert-danger fade in">Le contenu est invalide.</div><br />'; ?>
                    <textarea rows="5" name="message" class="form-control" placeholder="Message" id="message"></textarea>
                                <p class="help-block text-danger"></p>
                        </div>
                        </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-default">Envoyer</button>
                        </div>
                    </div>
        </form>
        </div>
    </div>
</div>
<hr>
<hr>
</body>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 text-center">
                <a type="button" id="pied" class="btn btn-default" href="admin/indexAdmin.php?&p=1">Interface d'administration</a>
                <ul class="list-inline text-center">
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">Copyright &copy; Blog de Jean Forteroche 2017</p>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="js/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Theme JavaScript -->
<script src="js/clean-blog.min.js"></script>

</body>
</html>
