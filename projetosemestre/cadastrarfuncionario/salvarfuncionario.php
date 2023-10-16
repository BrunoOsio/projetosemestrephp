<?php
session_start();
?>

<?php
require_once('../endpoints/endpoints.php');
require_once("../database/banco.php");
require_once("../helpers/stringHelpers.php");

function checkIdentifier()
{
  $hasProblems = !isset($_POST["identificador"]) || !isIdentifierUnique($_POST["identificador"]);
  if ($hasProblems) {
    $_SESSION['errors'][] = "Identificador do funcionário já cadastrado";
  }

  return $hasProblems;
}

function checkCpf()
{
  $hasProblems = !isset($_POST["cpf"]) || !isCpfUnique($_POST["cpf"]);

  if ($hasProblems) {
    $_SESSION['errors'][] = "CPF do funcionário já cadastrado";
  }

  return $hasProblems;
}

function checkRg()
{
  $hasProblems = !isset($_POST["rg"]) || !isRgUnique($_POST["rg"]);

  if ($hasProblems) {
    $_SESSION['errors'][] = "RG do funcionário já cadastrado";
  }

  return $hasProblems;
}

checkCpf();
checkIdentifier();
checkRg();

if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
  header("location: cadastrarfuncionario.php");
} else {
  $name = isset($_POST["nome"]) ? $_POST["nome"] : "Should not enter here";
  $firstName = getFirstName($name);
  $lastName = getFullLastName($name);
  $identifier = $_POST["identificador"];
  $cpf = $_POST["cpf"];
  $rg = isset($_POST["rg"]) ? $_POST["rg"] : "Should not enter here";
  $birthDateString = isset($_POST["nascimento"]) ? $_POST["nascimento"] : "Should not enter here";
  $birthDate = date('Y-m-d', strtotime($birthDateString));
  $sex = $_POST["sexo"];
  $seniority = $_POST["senioridade"];
  $state = $_POST["estado"];
  $project = $_POST["projeto"];

  $newEmployee = [
    "nome_usuario" => $firstName,
    "sobrenome_usuario" => $lastName,
    "identificador" => $identifier,
    "cpf" => $cpf,
    "rg" => $rg,
    "dt_nascimento" => $birthDate,
    "fl_sexo" => $sex,
    "id_senioridade" => $seniority,
    "uf_estado" => $state,
    "id_projeto" => $project,
  ];

  $isSucccess = saveEmployee($newEmployee);

  if ($isSucccess) {
    header("location: ../listafuncionarios/listafuncionarios.php");
  }

  echo "<h1>Erro Inesperado</h1>";
}
?>