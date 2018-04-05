<?php
require_once('../Connect_db.php');
session_start();


$categories = [];

    if (isset($_POST["name"])){
        $sql= "INSERT INTO CATEGORY(name) VALUES (:name);";
        $stmt = $bdd->prepare($sql);
        $stmt -> bindValue(':name', $_POST['name']);
        $stmt->execute();
    }
$sql = "SELECT idCategory,name FROM CATEGORY;";
$stmt = $bdd -> prepare($sql);
$stmt->execute();

$categories = $stmt->fetchAll();

if (isset($_POST["name"])){
    echo json_encode($categories);
    return;
}

if (isset($_POST["title"]) && isset($_POST["post"])) {

    $sql = "INSERT INTO POST(title, content,idCategory, datePost) VALUES (:title, :content,
            (SELECT C2.idCategory FROM POST INNER JOIN CATEGORY C2 on POST.idCategory = C2.idCategory WHERE C2.idCategory = :categoryId),
            CURRENT_DATE()
           );";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':title', $_POST['title']);
    $stmt->bindValue(':content', $_POST['post']);
    $stmt->bindValue(':categoryId', $_POST['category']);
//    $stmt->bindValue(':authorId', $_SESSION['id']);

    $stmt->execute();
}

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Admin Article </title>
</head>
<body>
<h1>Rédaction d'un article : </h1>
<div>
    <div>
        <div>Choisissez la catégorie :</div>
        <div>
            <select id="listCategories">
                <?php
                foreach ($categories as $category)
                {
                    echo "<option value='".$category[0]."'>".$category["name"]."</option>";
                }
                ?>
            </select>
        </div>
        <div>
            Ajouter une nouvelle catégorie :
            <button id="addCategory" >Créer une nouvelle catégorie</button>
        </div>
        <div>
            <input type="text" name="postTitle" id="postTitle" placeholder="Titre de l'article">
        </div>
    </div>
    <hr>
    <div><textarea name="editor"></textarea></div>
    <div>
        <button id="publish">Publier</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="//cdn.ckeditor.com/4.9.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );

    $('#addCategory').on('click', function(){
        var newName = prompt("Entrez le nom de votre catégorie :");
        $.ajax({
            method: "POST",
            data: {
                "name": newName
            },
            dataType: "json",
            success: function(categories){
                var categoriesHtml;
                for (category of categories){
                    categoriesHtml += "<option value='" + category[0] + "'>" + category["name"] +  "</option>";
                }
                $('#listCategories').html(categoriesHtml);
            }
        });
    });

    $('#publish').on('click', function(){
        $.ajax({
            method: "POST",
            data: {
                "post": CKEDITOR.instances.editor.getData(),
                "title": $("#postTitle").val(),
                "category" : $("#listCategories").val()
            },
            success: function(){
                window.location.href = "";
            }
        })
    });
</script>
</body>
</html>

