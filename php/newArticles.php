<?php
    $title = 'News';
    $currentPage = 'newArticles';
    include 'headBLOG.php';
    include "navbar.php";

    $sql = "SELECT 
        p.idPost as id,
        p.title as title,
        A.username as adminUser,
        C2.name as category,
        p.datePost as date,
        p.content as content
        FROM POST p
        LEFT JOIN ADMINISTRATEUR A 
          ON p.idAdmin = A.idAdmin
        LEFT JOIN CATEGORY C2 
          ON p.idCategory = C2.idCategory
        ORDER BY date DESC";
$stmt = $bdd -> prepare($sql);
$stmt->execute();
$posts = $stmt ->fetchAll();
?>
    <body>
    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <?php
                $compteur_articles=0;
                foreach ($posts as $post){

                   require 'Article_describe.php';

                    if (++$compteur_articles== count($posts)) break; // on prend tous les articles de la bdd
                }
                ?>
                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-primary " href="#">Newer</a>
                </nav>
            </div><!-- /.blog-main -->
            <?php include "Article_aside.php" ?>
        </div><!-- /.row -->
    </main><!-- /.container -->
<?php include "footer.php";