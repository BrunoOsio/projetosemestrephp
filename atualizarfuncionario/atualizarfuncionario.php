<?php
session_start();
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

  $useGetStates = getStates();
  $useGetProjects = getProjects();
  $useGetSex = getSex();
  $useGetSeniority = getSeniority();

  if (isset($_GET['id_usuario'])) {
    $employeeId = $_GET['id_usuario'];
    $useGetEmployeeById = getEmployeeById($employeeId)[0];
  }
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

    <?php
    $userFullname = $useGetEmployeeById["nome_usuario"] . " " . $useGetEmployeeById["sobrenome_usuario"];
    ?>

    <label for="nomefuncionario" class="form-label">Nome do funcionário</label><br>
    <input type="text" class="form-input" name="nome" required value=" <?php echo $userFullname; ?>"><br><br>
    <label for="identificador" class="form-label">CPF</label><br>
    <input type="text" class="form-input" name="cpf" required value="<?php echo $useGetEmployeeById["cpf"]; ?>"><br><br>
    <label for="identificador" class="form-label">RG</label><br>
    <input type="text" class="form-input" name="rg" required value="<?php echo $useGetEmployeeById["rg"]; ?>"><br><br>
    <label for="identificador" class="form-label">Data de nascimento</label><br>
    <input type="date" class="form-input" name="nascimento" required value="<?php echo $useGetEmployeeById["dt_nascimento"]; ?>"><br><br>

    <label for="sexo" class="form-label">Sexo</label><br>
    <select name="sexo" class="form-select">
      <?php
      foreach ($useGetSex as $sex) {
        $selectedAttribute = "";
        if ($useGetEmployeeById["fl_sexo"] == $sex["fl_sexo"]) {
          $selectedAttribute = "selected";
        }
        echo "<option $selectedAttribute value='" . $sex["fl_sexo"] . "'>" . capitalize($sex["nm_sexo"]) . "</option>";
      }
      ?>
    </select><br>

    <!-- senioridade -->
    <label for="senioridade" class="form-label">Senioridade</label><br>
    <select name="senioridade" class="form-select">
      <?php
      foreach ($useGetSeniority as $seniority) {
        $selectedAttribute = "";
        if ($useGetEmployeeById["id_senioridade"] == $seniority["id_senioridade"]) {
          $selectedAttribute = "selected";
        }
        echo "<option $selectedAttribute value='" . $seniority["id_senioridade"] . "'>" . capitalize($seniority["nm_senioridade"]) . "</option>";
      }
      ?>
    </select><br>

    <!-- estado -->
    <label for="estado" class="form-label">Estado</label>
    <select name="estado" class="form-select">
      <?php
      foreach ($useGetStates as $state) {
        $selectedAttribute = "";
        if ($useGetEmployeeById["uf_estado"] == $state["uf_estado"]) {
          $selectedAttribute = "selected";
        }
        echo "<option $selectedAttribute value='" . $state["uf_estado"] . "'>" . capitalize($state["nm_estado"]) . "</option>";
      }
      ?>
    </select>

    <!-- projeto -->
    <br>
    <label for="projeto" class "form-label">Projeto do funcionário</label>
    <select name="projeto" class="form-select">
      <?php
      foreach ($useGetProjects as $project) {
        $selectedAttribute = "";
        if ($useGetEmployeeById["id_projeto"] == $project["id_projeto"]) {
          $selectedAttribute = "selected";
        }
        echo "<option $selectedAttribute value='" . $project["id_projeto"] . "'>" . capitalize($project["nm_projeto"]) . "</option>";
      }
      ?>
    </select>
    <br>
    <button type="submit" class="form-button">Enviar dados</button>
  </form>
</body>

</html>
