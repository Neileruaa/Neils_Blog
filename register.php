<?php
require_once('Connect_db.php');

$password = "123";
$username = "aurelien";
$email = "aureliendrey@gmail.com";

$sql = "INSERT INTO ADMINISTRATEUR(username, password, email) VALUES (:username, :password, :email)";
$stmt = $bdd->prepare($sql);
$stmt->bindValue(':username', $username);
$stmt->bindValue(':password', $password);
$stmt->bindValue(':email', $email);
$stmt->execute();
echo $username . "admin user had been created";
?>