<html>
    <head>
        <title>Accueil du site</title>
        <meta charset="utf-8" />
        <link href="../css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            #pied{ text-align: center;}
        </style>
    </head>

    <body>
    <div class="container">

<?php
include "header.php";
?>

<?php
    echo '<h2 style="text-align:center">Liste des 5 derniers articles</h2>';

        foreach ($listeArticle as $article) {
            if (strlen($article->contenu()) <= 200) {
                $contenu = $article->contenu();
            } else {
                $debut = substr($article->contenu(), 0, 200);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

                $contenu = $debut;
            }

            echo '<h4><a href="controlleurUnArticle.php?id=', $article->id(), '">', $article->titre(), '</a></h4>', "\n",
            '<p>', nl2br($contenu), '</p>';
        }

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
<?php
include "footer.php";
?>
    </div>
    </body>
</html>
