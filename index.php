<?php
session_start();

$_SESSION = array();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="login.php" method="post">
    <label for="user">Usuário</label>
    <input type="text" name="user"> <br><br>
    <label for="pass">Senha</label>
    <input type="password" name="password"/><br><br>
    <button type="submit">Logar</button>
  </form>
</body>
</html>
