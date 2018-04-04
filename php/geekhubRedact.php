<?php
$title = "GeekHub : Article";

require 'headBLOG.php';
echo "<body>";
require "navbar.php";?>

<?php
if(isset($_GET['id']) and $_GET['id']>0){
    $article_toShow=$_GET['id'];
}
if (isset($article_toShow)){
    $content = $DB->requete('SELECT * FROM article WHERE id='.$article_toShow);
//echo $content[0]->title;
}
?>

<main role="main" class="container">
    <div class="row">
        <div class="col-sm-10 blog-main">
            <h1><?= $content[0]->title; ?></h1>
            <p class="blog-post-meta"><?= strftime("%d %b %Y",strtotime($content[0]->dateAdded));?> par <a href="aboutUs.php"><?= $content[0]->author; ?></a></p>
            <hr>
            <p>
                <?= $content[0]->content; ?>
            </p>


        </div>
    </div>
</main>

<footer class="blog-footer">
    <p>
        <a href="cover.php">Retour au "cover"</a>
    </p>
    <p>Blog réalisé par Aurélien</p>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>