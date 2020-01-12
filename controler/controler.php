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

function trylogin($username, $password)
{
    var_dump($username);
    var_dump($password);
    $listUsers = getUsers();
    foreach ($listUsers as $userinrun) {
        var_dump($userinrun['username'] );
        var_dump($userinrun['password'] );


        if ($username == $userinrun['username'] && $password == $userinrun['password']) {
            $_SESSION['username'] = $userinrun['username'];

        } else {
            unset($_SESSION['username']);
            home();
            die();
        }
        var_dump($_SESSION['username']);
    }

    require_once "view/home.php";
}

function disconnect(){
    unset($_SESSION['username']);
    session_abort();
    require_once "view/home.php";
}

function createaaccount(){

    require_once 'view/createaccount.php';
}

?>
