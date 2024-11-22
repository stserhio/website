<?php
global $pdo;
$login= trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

if(strlen($login)< 2){
    echo "Login is too short";
    exit;
}
if (strlen($password)<5){
    echo "Password is too short";
    exit;
}

//Password
$salt = 'sdfssdf@w4rsdfjsjdkf1112';
$password = md5($salt.$password);

require "db.php";

$sql = 'SELECT id FROM users WHERE login = ? AND password = ?';
$query = $pdo->prepare($sql);
$query->execute([$login, $password]);

if($query->rowCount() == 0){
    echo "Login or password is incorrect";
} else {
    echo "Done";
}
