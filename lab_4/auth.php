<?php
session_start();
$link = mysqli_connect('localhost', 'root' , '','bd');
$login = $_POST["login"];
$password = $_POST["password"];


$verify_user = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' ");
$_SESSION['check_user'] = $verify_user;
$user = mysqli_fetch_assoc($verify_user);

$_SESSION['user'] = [
    "id" => $user['id'],
    "name" => $user['name'],
    "surname" => $user['surname'],
    "login" => $user['login'],
    "password" => $user['password'],
    "role" => $user['role'],
    "lang" => $user['lang']
];

if ((mysqli_num_rows($verify_user) > 0))
{

$_SESSION['login'] = $login;
$_SESSION['password'] = $password;


if ($user['role'] == 'admin'){
    header('Location: users\admin.php'); 
}


if ($user['role'] == 'manager'){
    header('Location: users\manager.php'); 
}

if ($user['role'] == 'client'){
    header('Location: users\client.php');
}

}

