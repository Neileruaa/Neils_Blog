<?php
require_once('../Connect_db.php');
session_start();

if ($_SESSION['isAdmin'] == true) {
    echo "Welcome " . $_SESSION['authUser'];?>

    <br>
    <hr>
    <a href="Redactor.php">Rediger un article</a>
<?php }else {
    echo "Get out you're not authorized, Sign in ?";
    echo "<a href='index.php'>Connect</a>";

}


