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

    $useGetEmployees = getEmployees();
    var_dump($useGetEmployees[0]["id_usuario"]);
    ?>
    <?php include_once("../navbar/navbar.php") ?>

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
            foreach ($useGetEmployees as $employee) {
                $userId = $employee["id_usuario"];
                $editUrl = "/projetosemestre/atualizarfuncionario/atualizarfuncionario.php?id=$userId";
                $deleteUrl = "/projetosemestre/deletarfuncionario/deletarfuncionario.php?id=$userId";
                echo "<tr>";
                echo "<td>" . $employee['nome_usuario'] . "</td>";
                echo "<td>" . $employee['sobrenome_usuario'] . "</td>";
                echo "<td>" . $employee['cpf'] . "</td>";
                echo "<td>" . $employee['rg'] . "</td>";
                echo "<td>" . $employee['dt_nascimento'] . "</td>";
                echo "<td>" . $employee['nm_senioridade'] . "</td>";
                echo "<td>" . $employee['nm_projeto'] . "</td>";
                echo "<td>" . $employee['nm_estado'] . "</td>";
                echo "<td>" . $employee['nm_sexo'] . "</td>";
                echo "<td><a href='$editUrl'><button>Editar</button></a></td>";
                echo "<td><a href='$deleteUrl'><button>Deletar</button></a></td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>


</body>

</html>