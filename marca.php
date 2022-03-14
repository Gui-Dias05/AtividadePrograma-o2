<!DOCTYPE html>
<?php
include_once "acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $usuario_id = isset($_GET['usuario_id']) ? $_GET['usuario_id'] : "";
    if ($usuario_id > 0)
        $dados = buscarDados($usuario_id);
}

if ($acao == 'editar'){
    $usuario_id = isset($_GET['cpf']) ? $_GET['cpf'] : "";
    if ($usuario_id > 0)
        $dados = buscarDados($usuario_id);
}

if ($acao == 'editar'){
    $usuario_id = isset($_GET['usuario_idade']) ? $_GET['usuario_idade'] : "";
    if ($usuario_id > 0)
        $dados = buscarDados($usuario_id);
}

if ($acao == 'editar'){
    $usuario_id = isset($_GET['tempo']) ? $_GET['tempo'] : "";
    if ($usuario_id > 0)
        $dados = buscarDados($usuario_id);
}

//var_dump($dados);
?>
<html lang="pt-br">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="wusuario_idth=device-wusuario_idth, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuário</title>
</head>
<body>

<style>
        body{
        background-color: #808080;
        }

        h3, input{
            font-family: 'Lucusuario_ida Sans', 'Lucusuario_ida Sans Regular', 'Lucusuario_ida Grande', 'Lucusuario_ida Sans Unicode', Geneva, Verdana, sans-serif;
        }
    
</style>

<br>
<a usuario_id="listar" href="usuario.php"><button type="button" class="btn btn-dark btn-lg btn-block">Listar</button></a>
<a usuario_id="novo" href="marca.php"><button type="button" class="btn btn-dark btn-lg btn-block">Novo</button></a>
<br><br>
<form action="acao.php" method="post"> 
    <h3>usuario_id:</h3><input class="form-control bg-dark text-white" readonly  type="text" name="usuario_id" usuario_id="usuario_id" value="<?php if ($acao == "editar") echo $dados['usuario_id']; else echo 0; ?>" ><br>
    <h3>Nome:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="name" usuario_id="name" value="<?php if ($acao == "editar") echo $dados['name']; ?>"  placeholder="Inserir nome"><br>
    <h3>CPF:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="cpf" usuario_id="cpf" value="<?php if ($acao == "editar") echo $dados['cpf']; ?>"  placeholder="Inserir CPF"><br>
    <h3>usuario_idade:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="usuario_idade" usuario_id="usuario_idade" value="<?php if ($acao == "editar") echo $dados['usuario_idade']; ?>"  placeholder="Inserir usuario_idade"><br>
    <h3>Tempo:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="tempo" usuario_id="tempo" value="<?php if ($acao == "editar") echo $dados['tempo']; ?>" placeholder="Inserir tempo de jogo"><br>

    

    <input type="submit" class="btn btn-dark" name="acao" usuario_id="acao"  value="salvar"> 
</form><br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>