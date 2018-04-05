<?php
require_once('../Connect_db.php');
session_start();


if(){

}

$sql="";

$stmt = $bdd->prepare($sql);
$stmt->bindValue(':title', $_POST['title']);
$stmt->bindValue(':content', $_POST['post']);
$stmt->bindValue(':categoryId', $_POST['category']);
//    $stmt->bindValue(':authorId', $_SESSION['id']);

$stmt->execute();

