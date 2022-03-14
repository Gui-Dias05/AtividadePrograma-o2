<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao3 = isset($_GET['acao3']) ? $_GET['acao3'] : "";
    if ($acao3 == "excluir"){
        $computador_id = isset($_GET['computador_id']) ? $_GET['computador_id'] : 0;
        excluir($computador_id);
    }

    // Se foi enviado via POST para acao3 entra aqui
    $acao3 = isset($_POST['acao3']) ? $_POST['acao3'] : "";
    if ($acao3 == "salvar"){
        $computador_id = isset($_POST['computador_id']) ? $_POST['computador_id'] : "";
        if ($computador_id == 0)
            inserir($computador_id);
        else
            editar($computador_id);
    }

    // Métodos para cada operação
    function inserir($computador_id){
        $dados = dadosForm();
        //var_dump($dados)
        
        $pdo = Conexao::getInstance();
        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        $faixaetaria = isset($_POST['faixaetaria']) ? $_POST['faixaetaria'] : "";
        $computador_computador_id = isset($_POST['computador_computador_id']) ? $_POST['computador_computador_id'] : "";
        $stmt = $pdo->prepare('INSERT INTO jogocomp (nome, faixaetaria, computador_computador_id) VALUES(:nome, :faixaetaria, :computador_computador_id)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':faixaetaria', $faixaetaria, PDO::PARAM_STR);
        $stmt->bindParam(':computador_computador_id', $computador_computador_id, PDO::PARAM_STR);
        $nome = $dados['nome'];
        $faixaetaria = $dados['faixaetaria'];
        $computador_computador_id = $dados['computador_computador_id'];
        $stmt->execute();
        header("location:jogocomp.php");
        
    }

    function editar($computador_id){
        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        $faixaetaria = isset($_POST['faixaetaria']) ? $_POST['faixaetaria'] : "";
        $computador_computador_id = isset($_POST['computador_computador_id']) ? $_POST['computador_computador_id'] : "";
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE `ativprog3`.`jogos` SET `nome` = :nome, `faixaetaria` = :faixaetaria, `computador_computador_id` = :computador_computador_id WHERE (`computador_id` = :computador_id);');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':faixaetaria', $faixaetaria, PDO::PARAM_STR);
        $stmt->bindParam(':computador_computador_id', $computador_computador_id, PDO::PARAM_STR);
        $stmt->bindParam(':computador_id', $computador_id, PDO::PARAM_INT);
        $nome = $dados['nome'];
        $faixaetaria = $dados['faixaetaria'];
        $computador_computador_id = $dados['computador_computador_id'];
        $computador_id = $dados['computador_id'];
        $stmt->execute();
        header("location:jogocomp.php");
    }

    function excluir($computador_id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from jogos WHERE computador_id = :computador_id');
        $stmt->bindParam(':computador_id', $computador_id, PDO::PARAM_INT);
        $computador_idD = $computador_id;
        $stmt->execute();
        header("location:jogocomp.php");
        
        //echo "Excluir".$computador_id;

    }

    // Busca um item pelo código no BD
    function buscarDados($computador_id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM jogos WHERE computador_id = $computador_id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['computador_id'] = $linha['computador_id'];
            $dados['nome'] = $linha['nome'];
            $dados['faixaetaria'] = $linha['faixaetaria'];
            $dados['computador_computador_id'] = $linha['computador_computador_id'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['computador_id'] = $_POST['computador_id'];
        $dados['nome'] = $_POST['nome'];
        $dados['faixaetaria'] = $_POST['faixaetaria'];
        $dados['computador_computador_id'] = $_POST['computador_computador_id'];
        return $dados;
    }

?>