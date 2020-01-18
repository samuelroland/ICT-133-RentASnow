<?php

function getNews()
{
    return json_decode(file_get_contents("model/dataStorage/news.json"), true);
}

function getProducts()
{
    return json_decode(file_get_contents("model/dataStorage/TypeSnows.json"), true);
}

function getUsers()
{
    return json_decode(file_get_contents("model/dataStorage/Users.json"), true);//recevoir la liste des utilisateurs
}

function addUser($firstname, $lastname, $email, $password, $birthdate, $wantnewsvalue)
{

    $listUsers = getUsers();
    $newUser = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'password' => $password,
        'birthdate' => $birthdate,
        'wantnews' => $wantnewsvalue,
        'date-inscription' => date("Y-m-d", time()),
        'employe' => false  //by default
    ];
    $listUsers[] = $newUser;
    file_put_contents("model/dataStorage/Users.json", json_encode($listUsers));

}

?>