<?php
require_once('../Connect_db.php');
session_start();

if ($_SESSION['isAdmin'] == true) {
    echo "Welcome " . $_SESSION['authUser'];
}else {
    echo "Get out you're not authorized";
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
            <select>
                <?php
                foreach ($categories as $category)
                {
                    echo "<option value='".$category."'>".$category."</option>";
                }
                ?>
            </select>
        </div>
        <div>
            Ajouter une nouvelle catégorie :
            <button id="addCategory">Créer une nouvelle catégorie</button>
        </div>
    </div>
    <div><textarea name="editor"></textarea></div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
</body>
</html>

