<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao3 = isset($_GET['acao3']) ? $_GET['acao3'] : "";
    if ($acao3 == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    }

    // Se foi enviado via POST para acao3 entra aqui
    $acao3 = isset($_POST['acao3']) ? $_POST['acao3'] : "";
    if ($acao3 == "salvar"){
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
        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        $faixaetaria = isset($_POST['faixaetaria']) ? $_POST['faixaetaria'] : "";
        $computador_id = isset($_POST['computador_id']) ? $_POST['computador_id'] : "";
        $stmt = $pdo->prepare('INSERT INTO jogocomp (nome, faixaetaria, computador_id) VALUES(:nome, :faixaetaria, :computador_id)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':faixaetaria', $faixaetaria, PDO::PARAM_STR);
        $stmt->bindParam(':computador_id', $computador_id, PDO::PARAM_STR);
        $nome = $dados['nome'];
        $faixaetaria = $dados['faixaetaria'];
        $computador_id = $dados['computador_id'];
        $stmt->execute();
        header("location:jogocomp.php");
        
    }

    function editar($id){
        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        $faixaetaria = isset($_POST['faixaetaria']) ? $_POST['faixaetaria'] : "";
        $computador_id = isset($_POST['computador_id']) ? $_POST['computador_id'] : "";
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE `ativprog3`.`jogos` SET `nome` = :nome, `faixaetaria` = :faixaetaria, `computador_id` = :computador_id WHERE (`id` = :id);');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':faixaetaria', $faixaetaria, PDO::PARAM_STR);
        $stmt->bindParam(':computador_id', $computador_id, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $nome = $dados['nome'];
        $faixaetaria = $dados['faixaetaria'];
        $computador_id = $dados['computador_id'];
        $id = $dados['id'];
        $stmt->execute();
        header("location:jogocomp.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from jogos WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:jogocomp.php");
        
        //echo "Excluir".$id;

    }

    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM jogos WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['nome'] = $linha['nome'];
            $dados['faixaetaria'] = $linha['faixaetaria'];
            $dados['computador_id'] = $linha['computador_id'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['nome'] = $_POST['nome'];
        $dados['faixaetaria'] = $_POST['faixaetaria'];
        $dados['computador_id'] = $_POST['computador_id'];
        return $dados;
    }

?>