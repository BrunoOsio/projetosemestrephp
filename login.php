<?php
session_start();
?>

<?php

require_once('./database/banco.php');
require_once('./endpoints/endpoints.php');
require_once('./helpers/stringHelpers.php');

if (login($_POST["user"], $_POST["password"])) {
  $_SESSION['user'] = $_POST["user"];
  $_SESSION['password'] = $_POST["password"];
  header("location: ./listafuncionarios/listafuncionarios.php");

} else {
  header("location: ./index.php");
}
?>
