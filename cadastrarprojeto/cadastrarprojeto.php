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
    <link rel="stylesheet" href="../cadastrarfuncionario/styles.css">
    <title>Document</title>
</head>

<body>
    <?php

    require_once('../database/banco.php');
    require_once('../endpoints/endpoints.php');
    require_once('../helpers/stringHelpers.php');

    ?>
    <?php include_once("../navbar/navbar.php") ?>
    <form action="salvarprojeto.php" method="post" class="form">
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
        <label for="nomeprojeto" class="form-label">Nome do projeto</label><br>
        <input type="text" class="form-input" name="nome" required><br><br>
        <button type="submit" class="form-button">Enviar dados</button>
    </form>
</body>

</html>