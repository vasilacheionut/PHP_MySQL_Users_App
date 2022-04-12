<?php
//Do not remove session_start
session_start();

define('SERVERNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'usersapp');

include './database/database.php';
include './model/users.php';

$db   = new Database();
$user = new Users($db);

if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {
    $user->login($_SESSION["username"], $_SESSION["password"]);    
}