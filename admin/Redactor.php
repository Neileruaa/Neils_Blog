<?php
require_once('../Connect_db.php');
session_start();

if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
    echo "Unauthorized Access";
    exit;
}

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
    header("Refresh:0");
}
if (isset($_POST['postTitle']) && $_POST['postTitle']!= ""
        && isset($_POST['submit'])
        && isset($_POST['editor'])
){
    $_SESSION['idCategory'] = $_POST['listCategories'];
    $_SESSION['postTitle'] = $_POST['postTitle'];
    $_SESSION['editor'] = $_POST['editor'];
    header("Location: Article_add.php");
}
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Admin Article </title>
</head>
<body>
<h1>Rédaction d'un article : </h1>
<form method="POST" action="Redactor.php">
    <div>
        <div>Choisissez la catégorie :</div>
        <div>
            <select name="listCategories">
                <?php
                foreach ($categories as $category)
                {
                    echo "<option value='".$category['idCategory']."'>".$category["name"]."</option>";
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

    <input type="submit" id="submit" name="submit" value="Submit">
</form>

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

    CKEDITOR.on('instanceReady', function (ev) {
        ev.editor.dataProcessor.htmlFilter.addRules( {
            elements : {
                img: function( el ) {
                    // Add bootstrap "img-responsive" class to each inserted image
                    el.addClass('img-fluid');

                    // Remove inline "height" and "width" styles and
                    // replace them with their attribute counterparts.
                    // This ensures that the 'img-responsive' class works
                    var style = el.attributes.style;

                    if (style) {
                        // Get the width from the style.
                        var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
                            width = match && match[1];

                        // Get the height from the style.
                        match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
                        var height = match && match[1];

                        // Replace the width
                        if (width) {
                            el.attributes.style = el.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
                            el.attributes.width = width;
                        }

                        // Replace the height
                        if (height) {
                            el.attributes.style = el.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
                            el.attributes.height = height;
                        }
                    }

                    // Remove the style tag if it is empty
                    if (!el.attributes.style)
                        delete el.attributes.style;
                }
            }
        });
    });
</script>
</body>
</html>

