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
    <?php include_once "menu1.php"; ?><br>
    <form method="post">
        <input type="radio" id="id" name="busca" value="id" <?php if($busca == "id"){echo "checked";}?>>
        <label for="huey"><h3>#ID</h3></label>
        <br>
        <input type="radio" id="name" name="busca" value="name" <?php if($busca == "name"){echo "checked";}?>>
        <label for="huey"><h3>name</h3></label>
        <br><br>
        <input type="submit" class="btn btn-dark"  value="Consultar">
        <br><br>
    
    </form>
    <style> 
    table{
        text-align: center;
        font-family: 'Luccomputador_ida Sans', 'Luccomputador_ida Sans Regular', 'Luccomputador_ida Grande', 'Luccomputador_ida Sans Unicode', Geneva, Verdana, sans-serif;
    }
    body{
        background-color: #808080;
    }
    .btn btn-primary{
        background-color: black;
    }
    h3, h2{
        font-family: 'Luccomputador_ida Sans', 'Luccomputador_ida Sans Regular', 'Luccomputador_ida Grande', 'Luccomputador_ida Sans Unicode', Geneva, Verdana, sans-serif;
    }
</style>
    <div class="">
    <table class="table table-dark table-striped">
            <thead>
                <tr class="table-dark">
                    <th>#ID</th>
                    <th>name</th>
                    <th>Faixa etária</th>
                    <th>ID Computador</th>
                    <th>ALTERAR</th>
                    <th>EXCLUIR</th>
                </tr>
            </thead>
            <tbody>
            <?php
            error_reporting(0);
                $type = "LIKE";
                $procurar = "'%". trim($procurar) ."%'";
                if($busca != "id" && $busca != "name"){
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
                    <th><?php echo $linha['id'];?></th>
                    <td><?php echo $linha['name'];?></td>
                    <td><?php echo $linha['faixaetaria'];?></td>
                    <td><?php echo $linha['computador_id'];?></td>
                    <td><a href="marca3.php?id=<?php echo $linha['id'];?>&comando=update"><img src="../img/history-solid.svg" style="width: 2rem;"></a></td>
                    <td><a onclick="return confirm('Deseja mesmo excluir?')" href="acao3.php?id=<?php echo $linha['id'];?>&tabela=titulo&comando=deletar"><img src="../img/trash.svg" style="width: 2rem;"></a></td>
                </tr>
            <?php } ?> 
            </body>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>