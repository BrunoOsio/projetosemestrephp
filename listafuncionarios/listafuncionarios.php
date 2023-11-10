<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #ccc;
        }

        tr:nth-child(even) {
            background-color: #eee;
        }

        .editar {
            color: #000;
            background-color: #ccc;
            padding: 5px;
            cursor: pointer;
        }

        .deletar {
            color: #fff;
            background-color: #f00;
            padding: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php

    require_once('../database/banco.php');
    require_once('../endpoints/endpoints.php');
    require_once('../helpers/stringHelpers.php');

    $useGetProjects = getProjects();

    $projectFilter = isset($_GET["projeto"]) ? $_GET["projeto"] : "todos_projetos";

    $useGetEmployeesByProject = null;
    if ($projectFilter == "todos_projetos") {
        $useGetEmployeesByProject = getEmployees();
    } else {
        $useGetEmployeesByProject = getEmployeesByProjectName($projectFilter);
    }
    
    ?>
    <?php include_once("../navbar/navbar.php") ?>

    <form action="/projetosemestre/listafuncionarios/listafuncionarios.php" method="get">
        <select name="projeto" class="form-select">
            <option value="todos_projetos" selected>
                <?php echo capitalize("Todos projetos") ?>
            </option>
            <?php
            $selectedAttribute = "";
            foreach ($useGetProjects as $project) {
                if ($projectFilter == $project["nm_projeto"]) {
                    $selectedAttribute = "selected";
                }
                echo "<option $selectedAttribute value='" . $project["nm_projeto"] . "'>" . capitalize($project["nm_projeto"]) . "</option>";
            }
            ?>
        </select>
        <button type="submit">Filtrar funcionários pelo projeto</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Data de nascimento</th>
                <th>Senioridade</th>
                <th>Projeto</th>
                <th>Estado</th>
                <th>Sexo</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($useGetEmployeesByProject as $employee) {
                $userId = $employee["id_usuario"];

                $editUrl = "/projetosemestre/atualizarfuncionario/atualizarfuncionario.php?id_usuario=$userId";

                echo "<tr>";
                echo "<td>" . $employee['nome_usuario'] . "</td>";
                echo "<td>" . $employee['sobrenome_usuario'] . "</td>";
                echo "<td>" . $employee['cpf'] . "</td>";
                echo "<td>" . $employee['rg'] . "</td>";
                echo "<td>" . $employee['dt_nascimento'] . "</td>";
                echo "<td>" . capitalize($employee['nm_senioridade']) . "</td>";
                echo "<td>" . capitalize($employee['nm_projeto']) . "</td>";
                echo "<td>" . capitalize($employee['nm_estado']) . "</td>";
                echo "<td>" . capitalize($employee['nm_sexo']) . "</td>";
                echo "<td><a href='$editUrl'><button>Editar</button></a></td>";
                echo "<td><form action='deletarfuncionario.php' method='post'><input type='hidden' name='id_usuario' value='$userId'/><button>Deletar</button></form></td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>


</body>

</html>