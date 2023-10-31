<?php
session_start();
?>

<?php
require_once('../endpoints/endpoints.php');
require_once("../database/banco.php");
require_once("../helpers/stringHelpers.php");

function checkId()
{
  $hasProblems = !isset($_POST["id_usuario"]);

  if ($hasProblems) {
    $_SESSION["errors"][] = "Erro inesperado no identificador do usuário, tente novamente";
  }

  return $hasProblems;
}

checkId();
if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
  echo $_SESSION["errors"][0];
  unset($_SESSION['errors']);
} else {
  $isEmployeeDataDeleted = deleteEmployee($_POST["id_usuario"]);

  if (!$isEmployeeDataDeleted) {
    throw new Exception("Error");
  }
}

header("location: ../listafuncionarios/listafuncionarios.php");
?>