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

function getOneUser($email)
{
    $listUsers = getUsers();
    foreach ($listUsers as $OneUser) {
        if ($OneUser['email'] == $email) {
            return $OneUser;
        }
    }
    return "";
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

function addSnowModel($modele, $marque, $bigimage, $smallimage)
{
    $listSnowsModeles = getProducts();
    $newModel = [
        'idtype' => count($listSnowsModeles) + 1,   //id du modèle de snow suivant.
        'modele' => $modele,
        'marque' => $marque,
        'bigimage' => $bigimage,
        'smallimage' => $smallimage
    ];

    $listSnowsModeles[] = $newModel;    //insérer ce nouveau modèle à la fin du tableau.
    file_put_contents("model/dataStorage/TypeSnows.json", json_encode($listSnowsModeles)); //enregistrer dans le fichier json.

}

?>