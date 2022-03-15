<!DOCTYPE html>
<?php
    include_once "../ativprog3/conf/default.inc.php";
    require_once "../ativprog3/conf/Conexao.php";
    include_once "acao3.php";
    $comando = isset($_GET['comando']) ? $_GET['comando'] : "";
    $tabela = "jogos";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $tabela);
    }
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $faixaetaria = isset($_POST['faixaetaria']) ? $_POST['faixaetaria'] : "";
    $computador_id = isset($_POST['computador_id']) ? $_POST['coputador_id'] : "";
    ?>
<html>
<head> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Chave estrangeira</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
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
<?php include "../ativprog3/menu1.php"; ?>



<br>
<a id="listar" href="jogocomp.php"><button type="button" class="btn btn-dark btn-lg btn-block">Listar</button></a>
<a id="novo" href="marca3.php"><button type="button" class="btn btn-dark btn-lg btn-block">Novo</button></a>
<br><br>
<form action="acao3.php" method="post">
    
    <h3>ID:</h3><input class="form-control bg-dark text-white" readonly  type="text" name="id" id="id" value="<?php if ($acao3 == "editar") echo $dados['id']; else echo 0; ?>"><br>
    <h3>Nome:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="name" id="name" value="<?php if ($acao3 == "editar") echo $dados['name']; ?>"><br>
    <h3>Faixa etária:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="faixaetaria" id="faixaetaria" value="<?php if ($acao3 == "editar") echo $dados['faixaetaria']; ?>"><br>
    <h3>Gênero:</h3> <input class="form-control bg-dark text-white" required=true   type="text" name="genero" id="genero" value="<?php if ($acao3 == "editar") echo $dados['genero']; ?>"><br>
    
    <br>
    <h3>ID computador</h3>
            <select name="computador_id" value="">
            <?php
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM computador");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option  name="" value="<?php echo $linha['computador_id']; ?>" <?php if ($comando == "update" && $linha['computador_id'] == $dados['computador_id']){echo "selected";}?>><?php echo $linha['computador_id'];?></option>
            <?php } ?>
            </select>  

    <input type="submit" class="btn btn-dark" name="acao3" id="acao3"  value="salvar">

</form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>