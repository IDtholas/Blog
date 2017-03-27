<html>
<head>
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
    <title>Accueil du site</title>
    <meta charset="utf-8" />
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../js/bootstrap.css">
    <style type="text/css">
        #pied{ text-align: center;}
    </style>
</head>

<body>
<div class="container">
    <header class="page-header">
        <h1> Blog de Jean Forteroche</h1>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../controllers/controlleurLesArticles.php?p=1">Les articles</a>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../controllers/controlleurAccueil.php">Accueil</a></li>
                        <li><a href="#">Biographie</a></li>
                        <li><a href="#">Me contacter</a></li>
                        <li><a href="#">Portefollio</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="col-sm-8">
<?php
if (isset($commentaire))
{
    echo '<p>Par <em>', $commentaire->auteur(), '</em>, le ', $commentaire->dateAjout()->format('d/m/Y à H\hi'), '</p>', "\n",
    '<h2>', $commentaire->titre(), '</h2>', "\n",
    '<p>', nl2br($commentaire->contenu()), '</p>', "\n";

?>
            <a href="controlleurAdministration.php?supprimerCom=<?php echo $commentaire->id();?>&p=1" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span> Supprimez le commentaire.</a>
        <?php
}
?>
    </section>
    <?php
    if (isset($message))
    {
        echo '<div class="row"> <div class="col-lg-12">', $message, '<br /></div></div>';
    }
    ?>
    <section class="col-sm-8">
        <form class="well" action="controlleurAdministration.php?p=1" method="post">
            <legende><h2>Ajoutez un article: </h2></legende>
            <fieldset>
                <div class="form-group">
                    <label for="auteur">Auteur de l'article:</label>
                    <?php if (isset($erreurs) && in_array(Article::AUTEUR_INVALIDE, $erreurs)) echo ' <div class="alert alert-danger fade in"> L\'auteur est invalide.</div><br />'; ?>
                    <input type="text" name="auteur" value="<?php if (isset($article)) echo $article->auteur(); ?>" class="form-control" id="auteur">
                </div>
                <div class="form-group">
                    <label for="titre">Titre de l'article:</label>
                    <?php if (isset($erreurs) && in_array(Article::TITRE_INVALIDE, $erreurs)) echo '<div class="alert alert-danger fade in">Le titre est invalide.</div><br />'; ?>
                    <input type="text" name="titre" value="<?php if (isset($article)) echo $article->titre(); ?>" class="form-control" id="titre">
                </div>
                <div class="form-group">
                    <label for="contenu">Rédigez votre article:</label>
                    <?php if (isset($erreurs) && in_array(Article::CONTENU_INVALIDE, $erreurs)) echo '<div class="alert alert-danger fade in">Le contenu est invalide.</div><br />'; ?>
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
    </section>

    <div class="row">
        <div class="col-lg-12"> <h2 style="text-align: center" class="jumbotron"> Il y a actuellement <?= $manager->count() ?> article. En voici la liste :</h2></div>
    </div>

    <table class="table">
        <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
        <?php
        foreach ($listeArticle as $article)
        {
            echo '<tr><td>', $article->auteur(), '</td><td>', $article->titre(), '</td><td>', $article->dateAjout()->format('d/m/Y à H\hi'), '</td><td>',
            ($article->dateAjout() == $article->dateModif() ? '-' : $article->dateModif()->format('d/m/Y à H\hi')), '</td><td><a type="button" class="btn btn-primary" href="?modifier=', $article->id(),'&p=1">Modifier</a> | <a type="button" class="btn btn-primary" href="?supprimer=', $article->id(),'&p=1">Supprimer</a></td></tr>', "\n";
        }

        ?>
    </table>
    <?php
    echo '<ul class="pagination" >';

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

    <div class="row">
        <div class="col-lg-12"> <h2 style="text-align: center" class="jumbotron"> Il y a actuellement <?= $managerCom->countModeration() ?> commentaire à modérer. En voici la liste :</h2></div>
    </div>

    <table class="table">
        <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Action</th></tr>
        <?php
        foreach ($listeComModeration as $commentaire)
        {
            echo '<tr><td>', $commentaire->auteur(), '</td><td>', $commentaire->titre(), '</td><td>', $commentaire->dateAjout()->format('d/m/Y à H\hi'), '</td>
            <td><a type="button" class="btn btn-primary" href="?moderer=', $commentaire->id(),'&p=1"> apercu du commentaire</a> | <a type="button" class="btn btn-primary" href="?supprimerCom=', $commentaire->id(),'&p=1">Supprimer</a></td></tr>', "\n";
        }

        ?>
    </table>
    <footer id="pied" >

        <div class="jumbotron" style="margin-top:25px;">
            <a type="button" class="btn btn-primary" href="../controllers/controlleurAccueil.php"> Retournez à l'accueil</a>
        </div>
    </footer>
</div>
</body>
</html>