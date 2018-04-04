<?php $title = 'News'; ?>
<?php $currentPage = 'newArticles'; ?>



<?php include 'headBLOG.php';?>
<?php include "navbar.php";?>
    <body>
    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <?php
                $articles = $DB->requete('SELECT * FROM article ORDER BY dateAdded DESC');
                $compteur_articles=0;
                foreach ($articles as $article){

                   require 'articleBlog.php';

                    if (++$compteur_articles== count($articles)) break; // on prend tous les articles de la bdd
                }
                ?>
                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-primary " href="#">Newer</a>
                </nav>
            </div><!-- /.blog-main -->
            <?php include "aside.php" ?>
        </div><!-- /.row -->
    </main><!-- /.container -->
<?php include "footer.php";