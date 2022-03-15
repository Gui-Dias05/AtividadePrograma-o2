<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao2 = isset($_GET['acao2']) ? $_GET['acao2'] : "";
    if ($acao2 == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    }

    // Se foi enviado via POST para acao2 entra aqui
    $acao2 = isset($_POST['acao2']) ? $_POST['acao2'] : "";
    if ($acao2 == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        if ($id == 0)
            inserir($id);
        else
            editar($id);
    }

    // Métodos para cada operação
    function inserir($id){
        $dados = dadosForm();
        //var_dump($dados)
        
        $pdo = Conexao::getInstance();
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $faixaetaria = isset($_POST['faixaetaria']) ? $_POST['faixaetaria'] : "";
        $genero = isset($_POST['genero']) ? $_POST['genero'] : "";
        $stmt = $pdo->prepare('INSERT INTO jogos (name, faixaetaria, genero) VALUES(:name, :faixaetaria, :genero)');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':faixaetaria', $faixaetaria, PDO::PARAM_STR);
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $name = $dados['name'];
        $faixaetaria = $dados['faixaetaria'];
        $genero = $dados['genero'];
        $stmt->execute();
        header("location:jogos.php");
        
    }

    function editar($id){
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $faixaetaria = isset($_POST['faixaetaria']) ? $_POST['faixaetaria'] : "";
        $genero = isset($_POST['genero']) ? $_POST['genero'] : "";
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE `jogos` SET `name` = :name, `faixaetaria` = :faixaetaria, `genero` = :genero WHERE (`id` = :id);');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':faixaetaria', $faixaetaria, PDO::PARAM_STR);
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $name = $dados['name'];
        $faixaetaria = $dados['faixaetaria'];
        $genero = $dados['genero'];
        $id = $dados['id'];
        $stmt->execute();
        header("location:jogos.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from jogos WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:jogos.php");
        
        //echo "Excluir".$id;

    }

    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM jogos WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['name'] = $linha['name'];
            $dados['faixaetaria'] = $linha['faixaetaria'];
            $dados['genero'] = $linha['genero'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['name'] = $_POST['name'];
        $dados['faixaetaria'] = $_POST['faixaetaria'];
        $dados['genero'] = $_POST['genero'];
        return $dados;
    }

?>