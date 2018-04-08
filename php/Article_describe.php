<div class="blog-post">
    <h2 class="blog-post-title"><a href="Article_show.php?id=<?= $post['id'];?>"><?=$post['title'];?></a></h2>
    <p class="blog-post-meta"><?= strftime("%d %b %Y",strtotime($post['date']));?> by <a href="AboutUs_page.php"><?= $post['adminUser']; ?></a></p>
    <hr>
    <p><?php custom_echo($post['content'], 900);  ?></p>
    <a class="btn btn-outline-primary btn-lg btn-block" href="Article_show.php?id=<?= $post['id'];?>">Read more</a>
</div><!-- /.blog-post -->