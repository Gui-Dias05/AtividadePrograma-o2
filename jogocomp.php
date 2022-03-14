<!DOCTYPE html>
<?php   
   include_once "../ativprog3/conf/conf.inc.php";
   require_once "../ativprog3/conf/Conexao.php";
   $title = "Jogos e computador";
   $busca = isset($_POST["busca"]) ? $_POST["busca"] : "id";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="">
    <?php include_once "menu1.php"; ?>
    <form method="post" style="background-color: rgb(33, 37, 41); color: #FFF;">
        <input type="radio" id="id" name="busca" value="id" <?php if($busca == "id"){echo "checked";}?>>
        <label for="huey"><h3>#ID</h3></label>
        <br>
        <input type="radio" id="nome" name="busca" value="nome" <?php if($busca == "nome"){echo "checked";}?>>
        <label for="huey"><h3>NOME</h3></label>
        <br><br>
        <div class="" style="padding-left: 10%;">
            <legend>Procurar: </legend>
            <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
            <button type="submit" class="btn btn-dark" name="acao" id="acao">
            </button>
            <br><br>
        </div>
    </form>
    <div class="">
        <table class="table table-striped" style="background-color: #FFF;">
            <thead>
                <tr class="table-dark">
                    <th scope="col">#ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Faixa etária</th>
                    <th scope="col">ID Computador</th>
                    <th scope="row">ALTERAR</th>
                    <th scope="row">EXCLUIR</th>
                </tr>
            </thead>
            <tbody>
            <?php
            error_reporting(0);
                $type = "LIKE";
                $procurar = "'%". trim($procurar) ."%'";
                if($busca != "id" && $busca != "nome"){
                    $type = "<=";
                    $procurar = ($_POST["procurar"]);
                    if(is_numeric($procurar) == false){
                        $procurar = 0;
                    }
                }
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM jogos, computador
                                        WHERE $busca $type $procurar
                                        AND jogos.computador_id = computador.computador_id
                                        ORDER BY $busca");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $linha['id'];?></th>
                    <td scope="row"><?php echo $linha['nome'];?></td>
                    <td scope="row"><?php echo $linha['faixaetaria'];?></td>
                    <td scope="row"><?php echo $linha['computador_id'];?></td>
                    <td scope="row"><a href="marca3.php?id=<?php echo $linha['id'];?>&comando=update"><img src="../img/history-solid.svg" style="width: 2rem;"></a></td>
                    <td><a onclick="return confirm('Deseja mesmo excluir?')" href="acao3.php?id=<?php echo $linha['id'];?>&tabela=titulo&comando=deletar"><img src="../img/trash.svg" style="width: 2rem;"></a></td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>
</body>
</html>