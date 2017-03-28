<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog de Jean Forteroche">
    <meta name="author" content=" Jean Forteroche">
    <title>Liste des articles du site</title>
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
        #pied{ margin: auto;}
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
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('../images/lesArticlesBackground.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Les articles</h1>
                    <hr class="small">
                    <span class="subheading">Bonne lecture</span>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h1 style="text-align:center">Liste des 5 derniers articles</h1><br>
            <?php foreach ($listeArticle as $article) {
            if (strlen($article->contenu()) <= 200) {
                $contenu = $article->contenu();
            } else {
                $debut = substr($article->contenu(), 0, 200);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

                $contenu = $debut;
            }?>
            <div class="post-preview">
                <a href="controlleurUnArticle.php?id=<?php echo $article->id();?>">
                    <h2 class="post-title">
                        <?php echo $article->titre();?>
                    </h2>
                    <h3 class="post-subtitle">
                        <?php echo $contenu; ?>
                    </h3>
                </a>
                <p class="post-meta">Rédigé par : <a href="controlleurAProposDeMoi.php"><?php echo $article->auteur();?></a> Le <?php echo $article->dateAjout()->format('d/m/Y à H\hi'); ?> .</p>
            </div>
            <hr>
<?php
            }
            echo '<ul class="pager" >';

            for ($nbPage = 1; $nbPage-1 <= ($nbArticle / 5); $nbPage++)
            {
                $pageActive = $_GET['p'];
                if($pageActive == $nbPage)
                {
                    echo  '<li class="active"><a href ="?p=',$nbPage,'" > ',$nbPage,'</a ></li >';
                }
                else
                {
                    echo '<li><a href ="?p=', $nbPage, '" > ', $nbPage, '</a ></li >';
                }
            }

            echo '</ul>';
?>
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

<!-- jQuery -->
<script src="../startbootstrap-clean-blog-gh-pages/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../startbootstrap-clean-blog-gh-pages/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Theme JavaScript -->
<script src="../startbootstrap-clean-blog-gh-pages/js/clean-blog.min.js"></script>

</body>
</html>
