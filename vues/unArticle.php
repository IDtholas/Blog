<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog de Jean Forteroche">
    <meta name="author" content=" Jean Forteroche">
    <title>Article du site</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../startbootstrap-clean-blog-gh-pages/css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../startbootstrap-clean-blog-gh-pages/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        #pied{ text-align: center;}
    </style>
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
                    <a class="navbar-brand" href="controlleurAccueil.php">Blog de Jean Forteroche</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="controlleurAccueil.php">Accueil</a>
                        </li>
                        <li>
                            <a href="controlleurlesArticles.php?p=1">Les articles</a>
                        </li>
                        <li>
                            <a href="controlleurApropos.php">A propos de moi</a>
                        </li>
                        <li>
                            <a href="controlleurContact.php">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <header class="intro-header" style="background-image: url('../images/unArticleBackground.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <div class="post-heading">
                            <h1><?php echo $article->titre();?></h1>
                            <h2 class="subheading">Bonne lecture, laissez un commentaire!</h2>
                            <span class="meta">Posté par <a href="#"><?php echo $article->auteur();?></a> Le <?php echo $article->dateAjout()->format('d/m/Y à H\hi'); ?> </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <?php
        if (isset($message))
        {
            echo '<div class="row"> <div class="col-lg-12">', $message, '<br /></div></div>';
        }
        ?>
        <article>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <?php echo $article->contenu();?>
                    </div>
                </div>
            </div>
        </article>
<?php    if ($article->dateAjout() != $article->dateModif())
    {
        echo '<p style="text-align: right;"><small><em>Modifié le ', $article->dateModif()->format('d/m/Y à H\hi'), '</em></small></p>';
    }
    ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-comment">
                        <h1>Commentaires :</h1>
                        <hr/>
                        <div class="row">
                            <section class="col-sm-8">
                                <form class="well" action="controlleurUnArticle.php?id=<?php echo $article->id()?>" method="post" >
                                    <legend> <?php echo $titreForm; ?> </legend>
                                    <fieldset>
                                        <label for="auteur">Votre nom :</label>
                                        <?php if (isset($erreurs) && in_array(Article::AUTEUR_INVALIDE, $erreurs)) echo ' <div class="alert alert-danger fade in"> L\'auteur est invalide.</div><br />'; ?>
                                        <input type="text" name="auteur" class="form-control" id="auteur">
                                        <label for="titre"> Titre du commentaire :</label>
                                        <?php if (isset($erreurs) && in_array(Article::TITRE_INVALIDE, $erreurs)) echo '<div class="alert alert-danger fade in">Le titre est invalide.</div><br />'; ?>
                                        <input type="text" name="titre" class="form-control" id="titre">
                                        <label for="contenu">Votre commentaire :</label>
                                        <?php if (isset($erreurs) && in_array(Article::CONTENU_INVALIDE, $erreurs)) echo '<div class="alert alert-danger fade in">Le contenu est invalide.</div><br />'; ?>
                                        <textarea id="textarea" name="contenu" id="contenu" class="form-control" rows="4"></textarea>
                                        <p class="help-block">Vous pouvez modifier la taille de la fenêtre.</p>
                                        <input type="hidden" name="depth" value="<?= $depthParent + 1 ?>" />
                                        <input type="hidden" name="idParent" value="<?= $idParent ?>" />
                                        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span> Envoyer</button>
                                    </fieldset>
                                </form>
                            </section>
                        </div></br>
                        <ul class="comments">
                            <?php foreach ($listeCom as $commentaire) {
                            $contenu = $commentaire->contenu(); ?>
                            <li class="commentaire">
                                <div>
                                    <p class="commentaire-tete">Par : <strong><?php echo $commentaire->auteur();?></strong> Le <?php echo $commentaire->dateAjout()->format('d/m/Y à H\hi'); ?>
                                       <a href="controlleurUnArticle.php?id=<?php echo $article->id();?>&moderer=<?php echo $commentaire->id();?>">
                                                    <i class="pull-right fa fa-exclamation-triangle fa-lg" data-toggle="tooltip" data-placement="top" title="Signalez un commentaire inapproprié"></i></a>
                                        <a href="controlleurUnArticle.php?id=<?php echo $article->id(); ?>&id_parent=<?php echo $commentaire->id(); ?>&depthParent=<?php echo $commentaire->depth(); ?>">
                                                <i class="pull-right fa fa-reply fa-lg " data-toggle="tooltip" data-placement="top" title="Répondre à ce commentaire"></i></a></p>
                                    <p>
                                        <?php echo nl2br($contenu); ?>
                                    </p>
                                </div>
                            </li></br>
                            <ul class="comments">

                                <?php foreach ($managerCom->getListSpe(0, 5, $_GET['id'], $commentaire->id(), 2) as $reponse1)
                                {
                                $contenu = $reponse1->contenu(); ?>
                                <li class="reponse1">
                                    <div class="post-comments">
                                        <p class="commentaire-tete">Par : <strong><?php echo $reponse1->auteur();?></strong> Le <?php echo $reponse1->dateAjout()->format('d/m/Y à H\hi'); ?>
                                            <a href="controlleurUnArticle.php?id=<?php echo $article->id();?>&moderer=<?php echo $reponse1->id();?>">
                                                <i class="pull-right fa fa-exclamation-triangle fa-lg" data-toggle="tooltip" data-placement="top" title="Signalez un commentaire inapproprié"></i></a>
                                            <a href="controlleurUnArticle.php?id=<?php echo $article->id(); ?>&id_parent=<?php echo $reponse1->id(); ?>&depthParent=<?php echo $reponse1->depth(); ?>">
                                                <i class="pull-right fa fa-reply fa-lg" data-toggle="tooltip" data-placement="top" title="Répondre à ce commentaire"></i></a></p>
                                            <?php echo  nl2br($contenu); ?>
                                        </p>
                                    </div>
                                </li></br>
                                <ul class="comments">

                                    <?php foreach ($managerCom->getListSpe(0, 5, $_GET['id'], $reponse1->id(), 3) as $reponse2) {
                                        $contenu = $reponse2->contenu(); ?>
                                        <li class="reponse2">
                                            <div class="post-comments">
                                                <p class="commentaire-tete">Par : <strong><?php echo $reponse2->auteur();?></strong> Le <?php echo $reponse2->dateAjout()->format('d/m/Y à H\hi'); ?>
                                                    <a href="controlleurUnArticle.php?id=<?php echo $article->id();?>&moderer=<?php echo $reponse2->id();?>">
                                                        <i class="pull-right fa fa-exclamation-triangle fa-lg" data-toggle="tooltip" data-placement="top" title="Signalez un commentaire inapproprié"></i></a>
                                                </p>
                                                    <?php echo  nl2br($contenu); ?>
                                                </p>
                                            </div>
                                        </li></br>
                                        <?php
                                    }
                                    echo '</ul>';
                                    }
                                    echo '</ul>';
                                    }
                                    echo '</ul>';?>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 text-center">
                        <a type="button" id="pied" class="btn btn-default" href="../admin/controlleurAdministration.php?p=1"> Accéder à l'interface d'administration</a>
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
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-muted">Copyright &copy; Blog de Jean Forteroche 2017</p>
                    </div>
                </div>
            </div>
        </footer>

        <script src="../js/tooltip.js"></script>
        <!-- jQuery -->
        <script src="../startbootstrap-clean-blog-gh-pages/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../startbootstrap-clean-blog-gh-pages/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Theme JavaScript -->
        <script src="../startbootstrap-clean-blog-gh-pages/js/clean-blog.min.js"></script>

        </body>
</html>