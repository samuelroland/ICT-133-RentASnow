<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 09:10
 * Updated by : 12-DEC-2019 - pascal.benzonana
 *                  remove cart and rents from 151
 */

//region calendar management
$timestamp = time('F');                                     //get current system date and time
$currentMonth = date('m', $timestamp);               //
$currentYear4Digits =  date("Y", $timestamp);       //current Year (sample : 2018)
$currentDay = date('j',$timestamp);                  //current day
$lastDayOfMonth = date('t',$timestamp);              //last day of current month
$lastDayOfPreviousMonth = date('t', strtotime('01-'.($currentMonth-1).'-'.$currentYear4Digits));
$daysFrench = array('Lun','Mar','Mer','Jeu','Ven','Sam','Dim');


$choosenMonth= @$_GET['month'];
$choosenYear= @$_GET['year'];


/**
 * @param : $currentMonth
 * @return : string
 */
function monthsInFrench($currentMonth)
{
    $monthsFrench = array('janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre');
    $month=$monthsFrench[$currentMonth-1];
    return strtoupper($month);
}


/**
 * @param $month
 * @param $year
 * @return false|string
 */
function getFirstDay($month, $year)
{
    $dayOfFirstDay = date(" N", mktime(12, 0, 0, $month, 1, $year ));
    return $dayOfFirstDay;
}

//end region


/**
 * This function is designed to redirect the user to the home page (depending on the action received by the index)
 */

function home(){
    $_GET['action'] = "home";
    require "view/home.php";
}

//region users management
/**
 * This function is designed to manage login request
 * @param $loginRequest containing login fields required to authenticate the user
 */
function login($loginRequest){
    //if a login request was submitted
    if (isset($loginRequest['inputUserEmailAddress']) && isset($loginRequest['inputUserPsw'])) {
        //extract login parameters
        $userEmailAddress = $loginRequest['inputUserEmailAddress'];
        $userPsw = $loginRequest['inputUserPsw'];

        //try to check if user/psw are matching with the database
        require_once "model/usersManager.php";
        if (isLoginCorrect($userEmailAddress, $userPsw)) {
            createSession($userEmailAddress);
            $idUser=getUser($userEmailAddress);
            require "model/rentManager.php";
            if (getRents($idUser))
                $_SESSION['haveRent']=true;
            $_GET['loginError'] = false;
            $_GET['action'] = "home";
            require "view/home.php";
        } else { //if the user/psw does not match, login form appears again
            $_GET['loginError'] = true;
            $_GET['action'] = "login";
            require "view/login.php";
        }
    }else{ //the user does not yet fill the form
        $_GET['action'] = "login";
        require "view/login.php";
    }
}

/**
 * This fonction is designed
 * @param $registerRequest
 */
function register($registerRequest){
    //variable set
    if (isset($registerRequest['inputUserEmailAddress']) && isset($registerRequest['inputUserPsw']) && isset($registerRequest['inputUserPswRepeat'])) {

        //extract register parameters
        $userEmailAddress = $registerRequest['inputUserEmailAddress'];
        $userPsw = $registerRequest['inputUserPsw'];
        $userPswRepeat = $registerRequest['inputUserPswRepeat'];

        if ($userPsw == $userPswRepeat){
            require_once "model/usersManager.php";
            if (registerNewAccount($userEmailAddress, $userPsw)){
                createSession($userEmailAddress);
                $_GET['registerError'] = false;
                $_GET['action'] = "home";
                require "view/home.php";
            }
        }else{
            $_GET['registerError'] = true;
            $_GET['action'] = "register";
            require "view/register.php";
        }
    }else{
        $_GET['action'] = "register";
        require "view/register.php";
    }
}

/**
 * This function is designed to create a new user session
 * @param $userEmailAddress : user unique id
 */
function createSession($userEmailAddress){
    $_SESSION['userEmailAddress'] = $userEmailAddress;
    //set user type in Session
    $userType = getUserType($userEmailAddress);
    $_SESSION['userType'] = $userType;
}

/**
 * This function is designed to manage logout request
 */
function logout(){
    $_SESSION = array();
    session_destroy();
    $_GET['action'] = "home";
    require "view/home.php";
}
//endregion


//region snows management

/**
 * This function is designed to get only one snow results (for aSnow view)
 * @param none
 */
function displayASnow($snow_code){
    if (isset($registerRequest['inputUserEmailAddress'])){
        //TODO
    }
    require_once "model/snowsManager.php";
    $snowsResults= getASnow($snow_code);
    require "view/aSnow.php";
}
//endregion

