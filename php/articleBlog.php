<div class="blog-post">
    <h2 class="blog-post-title"><a href="geekhubRedact.php?id=<?= $article->id;?>"><?=$article->title;?></a></h2>
    <p class="blog-post-meta"><?= strftime("%d %b %Y",strtotime($article->dateAdded));?> by <a href="aboutUs.php"><?= $article->author; ?></a></p>
    <hr>
    <p><?php custom_echo($article->content, 900);  ?></p>
    <a class="btn btn-outline-primary btn-lg btn-block" href="geekhubRedact.php?id=<?= $article->id;?>">Read more</a>
</div><!-- /.blog-post -->