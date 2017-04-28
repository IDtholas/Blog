<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog de Jean Forteroche">
    <meta name="author" content=" Jean Forteroche">
    <title>Page contact du site</title>
    <link href="http://blog-ecrivain.alexandre-drabczuk.fr/css/style.css" rel="stylesheet">
    <link href="http://blog-ecrivain.alexandre-drabczuk.fr/css/bootstrap.css" rel="stylesheet">
    <link href="http://blog-ecrivain.alexandre-drabczuk.fr/css/clean-blog.min.css" rel="stylesheet">

    <link href="http://blog-ecrivain.alexandre-drabczuk.fr/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body>
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="index.php">Blog de Jean Forteroche</a>
        </div>

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
    </div>
</nav>

<header class="intro-header" style="background-image: url('http://blog-ecrivain.alexandre-drabczuk.fr/images/contactBackground.jpg')">
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
    echo '', $message, '<br />';
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <p>Si vous souhaitez me contacter pour n'importe quelle raison, vous pouvez le faire via le formulaire ci-dessous : </p>
                <form method="post" action="index.php?action=contact" name="sentMessage" id="contactForm">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="nom">Nom</label>
                            <?php if (isset($erreurs) && in_array(Modele\Mailer::AUTEUR_INVALIDE, $erreurs)) echo ' <div class="alert alert-danger fade in"> L\'auteur est invalide.</div><br />'; ?>
                            <input type="text" name="nom" placeholder="Nom" class="form-control" id="nom">
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="email">Email</label>
                            <?php if (isset($erreurs) && in_array(Modele\Mailer::EMAIL_INVALIDE, $erreurs)) echo ' <div class="alert alert-danger fade in"> L\'email est invalide.</div><br />'; ?>
                            <input type="text" name="email" placeholder="Adresse email" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="titre">Titre du message</label>
                            <?php if (isset($erreurs) && in_array(Modele\Mailer::TITRE_INVALIDE, $erreurs)) echo ' <div class="alert alert-danger fade in"> Le titre est invalide.</div><br />'; ?>
                            <input type="text" name="titre" placeholder="Titre du message" class="form-control" id="titre">
                        </div>
                    </div>
                    <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                    <label for="message">Message</label>
                        <?php if (isset($erreurs) && in_array(Modele\Mailer::CONTENU_INVALIDE, $erreurs)) echo '<div class="alert alert-danger fade in">Le contenu est invalide.</div><br />'; ?>
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
                <a type="button" id="pied" class="btn btn-default" href="http://blog-ecrivain.alexandre-drabczuk.fr/admin/indexAdmin.php?&p=1">Interface d'administration</a>
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

<script src="http://blog-ecrivain.alexandre-drabczuk.fr/js/jquery/jquery.min.js"></script>

<script src="http://blog-ecrivain.alexandre-drabczuk.fr/js/bootstrap.min.js"></script>

<script src="http://blog-ecrivain.alexandre-drabczuk.fr/js/clean-blog.min.js"></script>

</body>
</html>
