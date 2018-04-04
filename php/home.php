    <?php $title = 'Home'; ?>
<?php $currentPage = 'home'; ?>



<?php include 'headBLOG.php';?>
<body>
<?php include "navbar.php";?>
<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>

    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">GeekHub</h1>
            <p class="lead blog-description"><q>If you can't explain it simply, you don't understand it well enough</q><cite>Albert Einstein </cite></p>
        </div>
    </div>
<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

           <?php
           $articles = $DB->requete('SELECT * FROM article ORDER BY author');
           $compteur_articles=0;
           foreach ($articles as $article){
            require 'Article_describe.php';
               if (++$compteur_articles== count($articles)) break; // on prend tous les articles de la bdd
           }
           ?>

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-primary " href="#">Newer</a>
            </nav>

        </div><!-- /.blog-main -->

        <?php include "Article_aside.php" ?>

        <button onclick="topFunction()" id="myBtn" class="btn" title="Go to top" style="padding: 0"><img src="../Images/fleche_haut.png" style="width: 45px;"></button>
    </div><!-- /.row -->

</main><!-- /.container -->

<?php include "footer.php";