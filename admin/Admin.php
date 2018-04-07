<?php
require_once('../Connect_db.php');
session_start();

$sql = "SELECT title, datePost, C2.name AS Categorie, A.username AS Auteur
        FROM POST
        LEFT JOIN ADMINISTRATEUR A 
          ON POST.idAdmin = A.idAdmin
        LEFT JOIN CATEGORY C2 
          ON POST.idCategory = C2.idCategory
        WHERE POST.idAdmin =".$_SESSION['id'].";";
$stmt = $bdd -> prepare($sql);
$stmt->execute();

$listArticles = $stmt->fetchAll();

if ($_SESSION['isAdmin'] == true) {
    echo "Welcome " . $_SESSION['authUser'];?>

    <br>
    <hr>
    <a href="Redactor.php">Rediger un article</a>
    <br>
    <br>
    <hr>

    <table border="2">
        <caption>Recapitulatifs articles</caption>
        <?php if(isset($listArticles[0])): ?>
            <thead>
            <tr>
                <th>title</th>
                <th>datePost</th>
                <th>Categorie</th>
                <th>Auteur</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($listArticles as $article):?>
                <tr>
                    <td>
                        <?= $article['title'] ?>
                    </td>
                    <td>
                        <?= $article['datePost'] ?>
                    </td>
                    <td>
                        <?= $article['Categorie'] ?>
                    </td>
                    <td>
                        <?= $article['Auteur'] ?>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        <?php else: ?>
            <tr>
                <td>Vous n'avez pas encore rédigé d'article</td>
            </tr>
        <?php endif; ?>
    </table>
<?php
}else {
    echo "Get out you're not authorized, Sign in ?";
    echo "<a href='index.php'>Connect</a>";

}


