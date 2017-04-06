<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog de Jean Forteroche">
    <meta name="author" content=" Jean Forteroche">
    <title>Interface d'administration du site</title>

    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/clean-blog.min.css" rel="stylesheet">

    <link href="../fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
            <a class="navbar-brand" href="../index.php">Blog de Jean Forteroche</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="../index.php">Accueil</a>
                </li>
                <li>
                    <a href="../index.php?action=lesArticles&p=1">Les articles</a>
                </li>
                <li>
                    <a href="../index.php?action=aPropos">A propos de moi</a>
                </li>
                <li>
                    <a href="../index.php?action=contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="intro-header" style="background-image: url('../images/administrationBackground.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Interface d'administration du site</h1>
                    <hr class="small">
                    <span class="subheading">Rédaction d'article et modération de commentaire</span>
                </div>
            </div>
        </div>
    </div>
</header>
<?php
if (isset($commentaire))
{
    echo '<div class="container well center-block"><p>Par <em>', $commentaire->auteur(), '</em>, le ', $commentaire->dateAjout()->format('d/m/Y à H\hi'), '</p>', "\n",
    '<h2>', $commentaire->titre(), '</h2>', "\n",
    '<p>', nl2br($commentaire->contenu()), '</p>', "\n";

?>
    <a href="indexAdmin.php?deModerer=<?php echo $commentaire->id();?>&p=1" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Ce commentaire est valide.</a> <a href="indexAdmin.php?supprimerCom=<?php echo $commentaire->id();?>&p=1" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> Supprimez le commentaire.</a> </div></br>
        <?php
}
?>
    <?php
    if (isset($message))
    {
        echo '', $message, '<br />';
    }
    ?>
    <div class="container well center-block">
        <form action="indexAdmin.php?p=1" method="post">
            <legende><h2>Ajoutez un article: </h2></legende>
            <fieldset>
                <div class="form-group">
                    <label for="auteur">Auteur de l'article:</label>
                    <?php echo $messageAuteurArticle; ?>
                    <input type="text" name="auteur" value="<?php if (isset($article)) echo $article->auteur(); ?>" class="form-control" id="auteur">
                </div>
                <div class="form-group">
                    <label for="titre">Titre de l'article:</label>
                    <?php echo $messageTitreArticle; ?>
                    <input type="text" name="titre" value="<?php if (isset($article)) echo $article->titre(); ?>" class="form-control" id="titre">
                </div>
                <div class="form-group>
                    <label for="contenu">Rédigez votre article:</label>
                <?php echo $messageContenuArticle; ?>
                    <textarea rows="17" cols="80" name="contenu" class="form-control" id="contenu"><?php if (isset($article)) echo $article->contenu(); ?></textarea>
                    <p class="help-block">Vous pouvez modifier la taille de la fenêtre.</p>
                </div>
                <?php
                if(isset($article) && !$article->isNew())
                {
                    ?>
                    <input type="hidden" name="id" class="form-control" value="<?= $article->id() ?>" />
                    <button type="submit" value="Modifier"  class="btn btn-primary" name="modifier"><span class="glyphicon glyphicon-ok-sign"></span> Modifier l'article</button>
                    <?php
                }
                else
                {
                    ?>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span>Enregistrez l'article</button>
                    <?php
                }
                ?>
            </fieldset>
        </form>
    </div>

        <div class="col-lg-12"> <h2 style="text-align: center" class="jumbotron"> Il y a actuellement <?= $this->manager->count() ?> article(s). En voici la liste :</h2></div>

    <table class="table">
        <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
        <?php
        foreach ($listeArticle as $article)
        {
            echo '<tr><td>', $article->auteur(), '</td><td>', $article->titre(), '</td><td>', $article->dateAjout()->format('d/m/Y à H\hi'), '</td><td>',
            ($article->dateAjout() == $article->dateModif() ? '-' : $article->dateModif()->format('d/m/Y à H\hi')), '</td><td><a type="button" class="btn btn-default" href="?modifier=', $article->id(),'&p=1">Modifier</a> | <a type="button" class="btn btn-danger" href="?supprimer=', $article->id(),'&p=1">Supprimer</a></td></tr>', "\n";
        }

        ?>
    </table>
    <?php
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

        <div class="col-lg-12"> <h2 style="text-align: center" class="jumbotron"> Il y a actuellement <?= $this->managerCom->countModeration() ?> commentaire(s) à modérer. En voici la liste :</h2></div>

    <table class="table">
        <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Action</th></tr>
        <?php
        foreach ($listeComModeration as $commentaire)
        {
            echo '<tr><td>', $commentaire->auteur(), '</td><td>', $commentaire->titre(), '</td><td>', $commentaire->dateAjout()->format('d/m/Y à H\hi'), '</td>
            <td><a type="button" class="btn btn-default" href="?moderer=', $commentaire->id(),'&p=1"> apercu du commentaire</a> | <a type="button" class="btn btn-danger" href="?supprimerCom=', $commentaire->id(),'&p=1">Supprimer</a></td></tr>', "\n";
        }

        ?>
    </table>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 text-center">
                    <a type="button" class="btn btn-default" href="../index.php"> Retournez à l'accueil</a>
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

    <script src="../js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
            selector: "textarea",
            language : "fr_FR",
            theme: "modern",
            width: 680,
            height: 300,
            subfolder:"",
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor filemanager"
            ],
            image_advtab: true,
            toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
        });</script>

    <script src="../js/jquery/jquery.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>

    <script src="../js/clean-blog.min.js"></script>
</body>
</html>