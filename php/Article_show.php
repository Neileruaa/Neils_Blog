<?php

$title = 'Article';
require 'headBLOG.php';

if(isset($_GET['id']) and $_GET['id']>0){
    $article_toShow=$_GET['id'];
}
if (isset($article_toShow)){
    $sql="
          SELECT
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
          WHERE p.idPost = :id;";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':id', $article_toShow);
    $stmt->execute();
    $post = $stmt->fetch();
}
echo "<body>";
require "navbar.php";?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<main role="main" class="container">
    <div class="row">
        <div class="col-sm-10 blog-main">
            <h1><?= $post['title']; ?></h1>
            <p class="blog-post-meta"><?= strftime("%d %b %Y",strtotime($post['date']));?> par <a href="AboutUs_page.php"><?=$post['adminUser']; ?></a></p>
            <hr>

                <?= $post['content']; ?>


        </div>
    </div>
</main>
<?php include 'footer.php'; ?>
