<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Usuário";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "2";
    $procurar = isset($_POST['procurar']) ? $_POST['procurar'] : "";
    $valorfim = isset($_POST['valorfim']) ? $_POST['valorfim'] : "";
?>
<html lang="pt-br">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="css/css.css" rel="stylesheet">
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>
    <style>
    table{
        text-align: center;
        font-family: 'Lucusuario_ida Sans', 'Lucusuario_ida Sans Regular', 'Lucusuario_ida Grande', 'Lucusuario_ida Sans Unicode', Geneva, Verdana, sans-serif;
    }
    body{
        background-color: #808080;
    }
    .btn btn-primary{
        background-color: black;
    }
    h3, h2{
        font-family: 'Lucusuario_ida Sans', 'Lucusuario_ida Sans Regular', 'Lucusuario_ida Grande', 'Lucusuario_ida Sans Unicode', Geneva, Verdana, sans-serif;
    }
</style>
</head>
<body>
<?php include "menu1.php"; ?>
<br>
<h2 class="text-dark">Usuário</h2>
</br>
<form method="post">
    <h3 class="input text-dark"><input class="form-check-input bg-dark" type="radio" name="tipo" usuario_id="tipo" value="1" <?php if ($tipo == 1) { echo "checked"; }?>>Id usuário</h3><br>  
    <h3 class="input text-dark"><input class="form-check-input bg-dark" type="radio"  name="tipo" usuario_id="tipo" value="2" <?php if ($tipo == 2) { echo "checked"; }?>>Nome</h3><br>
    <input class="form-control bg-dark text-white" type="text" name="procurar" usuario_id="procurar" placeholder="Digite para consultar" value="<?php echo $procurar; ?>">
    <br>
    <input type="submit" class="btn btn-dark"  value="Consultar">
</form>
<br>

<table class="table table-dark table-striped">
       <tr><th>ID usuário</th>
        <th>Name</th> 
        <th>CPF</th> 
        <th>usuario_idade</th>
        <th>Tempo em horas jogado</th>
        <th>Valor final</th>
        <th>Atualizar</th>  
        <th>Excluir</th> 

    </tr>

<?php
error_reporting(0);
    $sql = "";
    if ($tipo == 1){
        $sql = "SELECT * FROM usuario WHERE usuario_id = $procurar ORDER BY usuario_id";
    }else{    
        $sql = "SELECT * FROM usuario WHERE name LIKE '$procurar%' ORDER BY name";
    }

$pdo = Conexao::getInstance();
$consulta = $pdo->query($sql);

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $valorfim= $linha['tempo']*40;

    ?>

    <tr> <td ><?php echo $linha['usuario_id'];?></td>
    <td ><?php echo $linha['name'];?></td>
    <td ><?php echo $linha['cpf'];?></td>
    <td ><?php echo $linha['idade'];?></td>
    <td ><?php echo $linha['tempo'];?></td>
    <td  style="color: <?php if($valorfim>150){echo "#FF6961";}else{echo "#00BFFF";}?>;"><?php echo $valorfim;?></td><?php ?>
    <td ><a href='marca.php?acao=editar&usuario_id=<?php echo $linha['usuario_id'];?>'><center><img class="icon" src="img/editar.png" width="25" height="25" alt=""></center></a></td>
    <td ><a href="javascript:excluirRegistro('acao.php?acao=excluir&usuario_id=<?php echo $linha['usuario_id'];?>')"><center><img class="icon" src="img/deletar.png" wdth="25" height="25" alt=""></center></a></td>
</tr>
<?php } ?>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>