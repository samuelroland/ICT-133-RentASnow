<?php
/**
 *  Projet: page modele.php pour les fonctions de lecture et écriture des fichiers.
 *  Author: Samuel Roland
 *  Creation date: Janvier 2020.
 */
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
    return "";  //si rien trouvé retourne vide.
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

function deleteanaccountinjson($email)
{
    $listUsers = getUsers();
    foreach ($listUsers as $i => $OneUser) {
        if ($OneUser['email'] == $email) {
            unset($listUsers[$i]);
        }
    }
    file_put_contents("model/dataStorage/Users.json", json_encode($listUsers));
}

function modifyuserdata($email, $firstname, $lastname, $birthdate, $wantnews)
{
    $TheUser = getOneUser($email);

    if ($firstname !="") {
        $TheUser['firstname'] = $firstname;
    }
    if ($lastname !="") {
        $TheUser['lastname'] = $lastname;
    }
    if ($birthdate!="") {
        $TheUser['birthdate'] = $birthdate;
    }

    $TheUser['wantnews'] = isset($wantnews);    //de toute facon changer pour valider.

    $listUsers = getUsers();
    foreach ($listUsers as $i => $OneUser) {
        if ($OneUser['email'] == $email) {
            $listUsers[$i] = $TheUser;  // on change dans le tableau d'origine.
        }
    }
    file_put_contents("model/dataStorage/Users.json", json_encode($listUsers));
}

?>