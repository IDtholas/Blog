<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog de Jean Forteroche">
    <meta name="author" content=" Jean Forteroche">
    <title>Page les articles du site</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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

<header class="intro-header" style="background-image: url('images/lesArticlesBackground.jpg')">
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

                $contenu = strip_tags($debut);
            }?>
            <div class="post-preview">
                <a href="index.php?action=unArticle&id=<?php echo $article->id();?>">
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
                    echo  '<li class="active"><a href ="?action=lesArticles&p=',$nbPage,'" > ',$nbPage,'</a ></li >';
                }
                else
                {
                    echo '<li><a href ="?action=lesArticles&p=', $nbPage, '" > ', $nbPage, '</a ></li >';
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

<script src="js/jquery/jquery.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/clean-blog.min.js"></script>

</body>
</html>
