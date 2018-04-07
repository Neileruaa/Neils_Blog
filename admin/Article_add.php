<?php
require_once('../Connect_db.php');
session_start();

if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
    echo "Unauthorized Access";
    exit;
}


$authUser = $_SESSION['authUser'];
$id = $_SESSION['id'];
$idCategory = $_SESSION['idCategory'];
$postTitle = $_SESSION['postTitle'];
$editor = $_SESSION['editor'];

$sql="INSERT INTO POST(title, content,idCategory,idAdmin, datePost) VALUES (
        :title,
        :content,
        ( SELECT idCategory
          FROM CATEGORY
          WHERE idCategory = :categoryId),
        (SELECT idAdmin
        FROM ADMINISTRATEUR
        WHERE idAdmin = :authorId),        
        CURRENT_DATE()
      );";

$stmt = $bdd->prepare($sql);
$stmt->bindValue(':title', $postTitle);
$stmt->bindValue(':content', $editor);
$stmt->bindValue(':categoryId',$idCategory);
$stmt->bindValue(':authorId', $id);

$stmt->execute();

header("Location : Admin.php");