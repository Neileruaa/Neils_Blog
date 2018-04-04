<?php
require_once('../Connect_db.php');
session_start();

if ($_SESSION['isAdmin'] == true) {
    echo "Welcome " . $_SESSION['authUser'];
}else {
    echo "Get out you're not authorized";
}