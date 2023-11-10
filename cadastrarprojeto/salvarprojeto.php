<?php
session_start();
?>

<?php
require_once('../endpoints/endpoints.php');
require_once("../database/banco.php");
require_once("../helpers/stringHelpers.php");

$projectName = isset($_POST["nome"]) ? $_POST["nome"] : "Should not enter here";

$isSucccess = saveProject($projectName);

if ($isSucccess) {
  header("location: ../listafuncionarios/listafuncionarios.php");
}

echo "<h1>Erro Inesperado</h1>";
?>