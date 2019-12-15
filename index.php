<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 08:54
 * Update : 31-JAN-2019 - nicolas.glassey
 *          Simplify index. Remove all pages references.
 *          14-DEC-2019 - pascal benzonana
 *          Adapted for ICT-133 - Remove unused references
 *          
 */

session_start();
require "controler/controler.php";

if (isset($_GET['action'])) {
  $action = $_GET['action'];
  switch ($action) {
      case 'home' :
          home();
          break;
      case 'login' :
          login($_POST);
          break;
      case 'logout' :
          logout();
          break;
      case 'register' :
          register($_POST);
          break;
      default :
          home();
  }
}
else {
    home();
}