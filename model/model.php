<?php

function getNews()
{
    return json_decode(file_get_contents("model/dataStorage/news.json"), true);
}

function getProducts()
{
    return json_decode(file_get_contents("model/dataStorage/Snows.json"), true);
}

function getUsers()
{
    return json_decode(file_get_contents("model/dataStorage/Users.json"), true);//recevoir la liste des utilisateurs
}

function addUser($firstname, $lastname, $email, $password, $birthdate, $wantnews)
{

}

?>