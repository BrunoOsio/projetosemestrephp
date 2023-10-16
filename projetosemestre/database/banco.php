<?php
$isIfsulServers = false;
$bd_host_ifsul = "192.168.20.18";
$bd_host_home = "200.19.1.18";
$bd_host = $isIfsulServers ? $bd_host_ifsul : $bd_host_home;

$sgbd = "pgsql";
$base_de_dados = "brunojeronimo";
$bd_usuario = "brunojeronimo";
$bd_senha = "123456";

switch ($sgbd) {
    case "mysql":
		try {
			$dsn_mysql = "mysql:host=".$bd_host.";dbname=".$base_de_dados;
			$conn = new PDO($dsn_mysql, $bd_usuario, $bd_senha);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			die('ERROR: ' . $e->getMessage());
		}
        break;
    case "pgsql":
		try {
			$dsn_pgsql = "pgsql:host=$bd_host;port=5432;dbname=$base_de_dados;";
			$conn = new PDO(
				$dsn_pgsql,
				$bd_usuario,
				$bd_senha,
				[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
			);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
        break;
    case "sqlite":

		$conn = new PDO('sqlite:./sql/catalogo_de_games.sqlite3');
		$conn->setAttribute(PDO::ATTR_ERRMODE, 
									PDO::ERRMODE_EXCEPTION);
							
        break;
}

?>
