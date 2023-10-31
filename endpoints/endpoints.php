<?php

$tb_estado = "tb_estado";
$tb_projeto = "tb_projeto";
$tb_sexo = "tb_sexo";
$tb_senioridade = "tb_senioridade";
$tb_funcionario = "tb_funcionario";

function getStates()
{
    global $conn;
    global $tb_estado;

    $sql = "select * from $tb_estado order by nm_estado";
    $statement = $conn->prepare($sql);

    $statement->execute();

    return $statement->fetchAll();
}

function getProjects()
{
    global $conn;
    global $tb_projeto;

    $sql = "select * from $tb_projeto order by nm_projeto";
    $statement = $conn->prepare($sql);

    $statement->execute();

    return $statement->fetchAll();
}

function getSex()
{
    global $conn;
    global $tb_sexo;

    $sql = "select * from $tb_sexo";
    $statement = $conn->prepare($sql);

    $statement->execute();

    return $statement->fetchAll();
}

function getSeniority()
{
    global $conn;
    global $tb_senioridade;

    $sql = "select * from $tb_senioridade";
    $statement = $conn->prepare($sql);

    $statement->execute();

    return $statement->fetchAll();
}

function saveEmployee($employee)
{
    global $conn;
    global $tb_funcionario;

    $sql = "insert into $tb_funcionario (nome_usuario, sobrenome_usuario, identificador, cpf, rg, dt_nascimento, id_senioridade, id_projeto, uf_estado, fl_sexo) values (:nome_usuario, :sobrenome_usuario, :identificador, :cpf, :rg, :dt_nascimento, :id_senioridade, :id_projeto, :uf_estado, :fl_sexo)";
    $statement = $conn->prepare($sql);

    $statement->bindParam(':nome_usuario', $employee["nome_usuario"]);
    $statement->bindParam(':sobrenome_usuario', $employee["sobrenome_usuario"]);
    $statement->bindParam(':identificador', $employee["identificador"]);
    $statement->bindParam(':cpf', $employee["cpf"]);
    $statement->bindParam(':rg', $employee["rg"]);
    $statement->bindParam(':dt_nascimento', $employee["dt_nascimento"]);
    $statement->bindParam(':id_senioridade', $employee["id_senioridade"]);
    $statement->bindParam(':id_projeto', $employee["id_projeto"]);
    $statement->bindParam(':uf_estado', $employee["uf_estado"]);
    $statement->bindParam(':fl_sexo', $employee["fl_sexo"]);

    $statement->execute();

    return true;
}

function isIdentifierUnique($identifier)
{
    global $conn;
    global $tb_funcionario;

    $sql = "select * from $tb_funcionario where identificador = '$identifier'";
    $statement = $conn->prepare($sql);

    $statement->execute();

    return count($statement->fetchAll()) == 0;
}

function isCpfUnique($cpf)
{
    global $conn;
    global $tb_funcionario;

    $sql = "select * from $tb_funcionario where cpf = '$cpf'";
    $statement = $conn->prepare($sql);

    $statement->execute();

    return count($statement->fetchAll()) == 0;
}

function isRgUnique($rg)
{
    global $conn;
    global $tb_funcionario;

    $sql = "select * from $tb_funcionario where rg = '$rg'";
    $statement = $conn->prepare($sql);

    $statement->execute();

    return count($statement->fetchAll()) == 0;
}

function getEmployees()
{
    global $conn;
    global $tb_senioridade;
    global $tb_estado;
    global $tb_projeto;
    global $tb_sexo;
    global $tb_funcionario;

    $sql = "select 
        a.id_usuario,
	    a.nome_usuario, 
	    a.sobrenome_usuario, 
	    a.cpf, 
	    a.rg, 
	    a.dt_nascimento, 
	    b.nm_senioridade,
	    c.nm_projeto,
	    d.nm_estado,
	    e.nm_sexo
        from $tb_funcionario a 
        inner join $tb_senioridade b on b.id_senioridade = a.id_senioridade
        inner join $tb_projeto c on c.id_projeto = a.id_projeto
        inner join $tb_estado d on d.uf_estado = a.uf_estado
        inner join $tb_sexo e on e.fl_sexo = a.fl_sexo
        order by a.id_senioridade desc";
    $statement = $conn->prepare($sql);

    $statement->execute();

    return $statement->fetchAll();
}

function getEmployeeById($userId)
{
    global $conn;
    global $tb_senioridade;
    global $tb_estado;
    global $tb_projeto;
    global $tb_sexo;
    global $tb_funcionario;

    $sql = "select 
        a.id_usuario,
        a.nome_usuario, 
        a.sobrenome_usuario, 
        a.identificador,
        a.cpf, 
        a.rg, 
        a.dt_nascimento, 
        b.id_senioridade,
        c.id_projeto,
        d.uf_estado,
        e.fl_sexo
        from tb_funcionario a 
        inner join tb_senioridade b on b.id_senioridade = a.id_senioridade
        inner join tb_projeto c on c.id_projeto = a.id_projeto
        inner join tb_estado d on d.uf_estado = a.uf_estado
        inner join tb_sexo e on e.fl_sexo = a.fl_sexo
        where a.id_usuario = $userId";

    $statement = $conn->prepare($sql);

    $statement->execute();

    return $statement->fetchAll();
}

function getEmployeesByProjectName($projectName)
{
    global $conn;
    global $tb_senioridade;
    global $tb_estado;
    global $tb_projeto;
    global $tb_sexo;
    global $tb_funcionario;

    $sql = "select 
    a.id_usuario,
    a.nome_usuario, 
    a.sobrenome_usuario, 
    a.cpf, 
    a.rg, 
    a.dt_nascimento, 
    b.nm_senioridade,
    c.nm_projeto,
    d.nm_estado,
    e.nm_sexo
    from tb_funcionario a 
    inner join tb_senioridade b on b.id_senioridade = a.id_senioridade
    inner join tb_projeto c on c.id_projeto = a.id_projeto
    inner join tb_estado d on d.uf_estado = a.uf_estado
    inner join tb_sexo e on e.fl_sexo = a.fl_sexo
    where c.nm_projeto = '$projectName'";

    $statement = $conn->prepare($sql);

    $statement->execute();

    return $statement->fetchAll();
}

function deleteEmployee($userId)
{
    global $conn;
    global $tb_senioridade;
    global $tb_estado;
    global $tb_projeto;
    global $tb_sexo;
    global $tb_funcionario;

    $sql = "delete from $tb_funcionario where id_usuario = $userId";

    try {
        $statement = $conn->prepare($sql);
        $statement->execute();
    } catch (Exception $err) {
        echo "". $err->getMessage();
    }
    $statement = $conn->prepare($sql);

    $statement->execute();

    return true;
}
?>