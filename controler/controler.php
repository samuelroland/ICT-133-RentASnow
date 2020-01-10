<?php
require_once 'model/model.php';

// This file contains nothing but functions

function home()
{
    $news = getNews();
    require_once 'view/home.php';
}

function products()
{

    require_once 'view/products.php';
}

function trylogin()
{
    var_dump($_SESSION);
    var_dump($username);
    $listUsers = getUsers();
    foreach ($listUsers as $userinrun) {
        if ($username == $userinrun['username'] && $password == $userinrun['password']) {
            $_SESSION['username'] = $userinrun['username'];
            var_dump($_SESSION['username']);
        } else {
            home();
            die();
        }
    }



    require_once "view/home.php";
}

function disconnect(){
    var_dump($_SESSION['username']);
    var_dump($username);
    unset($_SESSION['username']);

    require_once "view/home.php";
}

?>
