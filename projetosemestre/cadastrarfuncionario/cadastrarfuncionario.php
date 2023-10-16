<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>
    <?php

    require_once('../database/banco.php');
    require_once('../endpoints/endpoints.php');
    require_once('../helpers/stringHelpers.php');

    $useGetStates = getStates();
    $useGetProjects = getProjects();
    $useGetSex = getSex();
    $useGetSeniority = getSeniority();

    ?>
    <?php include_once("../navbar/navbar.php") ?>
    <form action="salvarfuncionario.php" method="post" class="form">
        <?php
        if (!empty($_SESSION['errors'])) {
            echo "<div class='error-message'>";
            foreach ($_SESSION['errors'] as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";
            unset($_SESSION['errors']);
        }
        ?>
        <label for="nomefuncionario" class="form-label">Nome do funcionário</label><br>
        <input type="text" class="form-input" name="nome" required><br><br>
        <label for="identificador" class="form-label">Número identificador</label><br>
        <input type="text" class="form-input" name="identificador" required><br><br>
        <label for="identificador" class="form-label">CPF</label><br>
        <input type="text" class="form-input" name="cpf" required><br><br>
        <label for="identificador" class="form-label">RG</label><br>
        <input type="text" class="form-input" name="rg" required><br><br>
        <label for="identificador" class="form-label">Data de nascimento</label><br>
        <input type="date" class="form-input" name="nascimento" required><br><br>

        <label for="sexo" class="form-label">Sexo</label><br>
        <select name="sexo" class="form-select">
            <?php
            foreach ($useGetSex as $sex) {
                echo "<option value='" . $sex["fl_sexo"] . "'>" . capitalize($sex["nm_sexo"]) . "</option>";
            }
            ?>
        </select><br>

        <!-- senioridade -->
        <label for="senioridade" class="form-label">Senioridade</label><br>
        <select name="senioridade" class="form-select">
            <?php
            foreach ($useGetSeniority as $seniority) {
                echo "<option value='" . $seniority["id_senioridade"] . "'>" . capitalize($seniority["nm_senioridade"]) . "</option>";
            }
            ?>
        </select>

        <br>

        <!-- estado -->
        <label for="estado" class="form-label">Estado</label>
        <select name="estado" class="form-select">
            <?php
            foreach ($useGetStates as $state) {
                echo "<option value='" . $state["uf_estado"] . "'>" . capitalize($state["nm_estado"]) . "</option>";
            }
            ?>
        </select>

        <!-- projeto -->
        <br>
        <label for="projeto" class="form-label">Projeto do funcionário</label>
        <select name="projeto" class="form-select">
            <?php
            foreach ($useGetProjects as $project) {
                echo "<option value='" . $project["id_projeto"] . "'>" . capitalize($project["nm_projeto"]) . "</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit" class="form-button">Enviar dados</button>
    </form>
</body>

</html>