<?php
require_once('../Connect_db.php');


session_start();

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST['submit'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT username, password FROM ADMINISTRATEUR WHERE username = '".$username."';";
    echo $sql;
    $stmt = $bdd->query($sql);
    $result = $stmt->fetchAll();


    $isValid = ($password == $result[0]['password']);


    if  ($isValid){
        $_SESSION['isAdmin'] = true;
        echo $_SESSION['isAdmin'] ? 'true' : 'false';
        $_SESSION['authUser'] = $username;
        header('Location: http://localhost/Blog/admin/Admin.php');
    }

}
?>


<form  method="POST">
    <div>
        <h2>Login</h2>
    </div>
    <div>
        <input id="username" type="text" name="username" placeholder="Username">
    </div>
    <div>
        <input id="password" type="password" name="password" placeholder="Password">
    </div>
    <div>
        <input id="submit" name="submit" type="submit" value="Submit">
    </div>
</form>