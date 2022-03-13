<!DOCTYPE html>
<?php
include_once "acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}

if ($acao == 'editar'){
    $id = isset($_GET['cpf']) ? $_GET['cpf'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}

if ($acao == 'editar'){
    $id = isset($_GET['idade']) ? $_GET['idade'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}

if ($acao == 'editar'){
    $id = isset($_GET['tempo']) ? $_GET['tempo'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}

//var_dump($dados);
?>
<html lang="pt-br">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuário</title>
</head>
<body>

<style>
        body{
        background-color: #808080;
        }

        h3, input{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
    
</style>

<br>
<a id="listar" href="usuario.php"><button type="button" class="btn btn-dark btn-lg btn-block">Listar</button></a>
<a id="novo" href="marca.php"><button type="button" class="btn btn-dark btn-lg btn-block">Novo</button></a>
<br><br>
<form action="acao.php" method="post">
    <h3>ID:</h3><input class="form-control bg-dark text-white" readonly  type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>" ><br>
    <h3>Nome:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="name" id="name" value="<?php if ($acao == "editar") echo $dados['name']; ?>"  placeholder="Inserir nome"><br>
    <h3>CPF:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="cpf" id="cpf" value="<?php if ($acao == "editar") echo $dados['cpf']; ?>"  placeholder="Inserir CPF"><br>
    <h3>Idade:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="idade" id="idade" value="<?php if ($acao == "editar") echo $dados['idade']; ?>"  placeholder="Inserir idade"><br>
    <h3>Tempo:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="tempo" id="tempo" value="<?php if ($acao == "editar") echo $dados['tempo']; ?>" placeholder="Inserir tempo de jogo"><br>

    

    <input type="submit" class="btn btn-dark" name="acao" id="acao"  value="salvar"> 
</form><br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>