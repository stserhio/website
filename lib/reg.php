<?php
global $pdo;
$login= trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$username= trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

if(strlen($login)< 2){
    echo "Login is too short";
    exit;
}
if (strlen($username)<1){
    echo "Username is too short";
    exit;
}
if (strlen($password)<5){
    echo "Password is too short";
    exit;
}
if (strlen($email)< 3 && !str_contains($email, '@')){
    echo "Email is too short";
    exit;
}

//Password
$salt = 'sdfssdf@w4rsdfjsjdkf1112';
$password = md5($salt.$password);

//DB
require "db.php";


//INSERT

$sql = 'INSERT INTO users(login, username, email, password) VALUES(?, ?, ?, ?)';
$query = $pdo->prepare($sql)->execute([$login, $username, $email, $password]) ;

header('Location: /');