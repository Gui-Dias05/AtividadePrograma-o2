<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao1 entra aqui
    $acao1 = isset($_GET['acao1']) ? $_GET['acao1'] : "";
    if ($acao1 == "excluir"){
        $computador_id = isset($_GET['computador_id']) ? $_GET['computador_id'] : 0;
        excluir($computador_id);
    }

    // Se foi enviado via POST para acao1 entra aqui
    $acao1 = isset($_POST['acao1']) ? $_POST['acao1'] : "";
    if ($acao1 == "salvar"){
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
        $tipocomp = isset($_POST['tipocomp']) ? $_POST['tipocomp'] : "";
        $stmt = $pdo->prepare('INSERT INTO computador (tipocomp) VALUES(:tipocomp)');
        $stmt->bindParam(':tipocomp', $tipocomp, PDO::PARAM_STR);
        $tipocomp = $dados['tipocomp'];
        $stmt->execute();
        header("location:computador.php");
        
    }

    function editar($computador_id){
        $tipocomp = isset($_POST['tipocomp']) ? $_POST['tipocomp'] : "";
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE `ativprog3`.`computador` SET `tipocomp` = :tipocomp WHERE (`computador_id` = :computador_id);');
        $stmt->bindParam(':tipocomp', $tipocomp, PDO::PARAM_STR);
        $stmt->bindParam(':computador_id', $computador_id, PDO::PARAM_INT);
        $tipocomp = $dados['tipocomp'];
        $computador_id = $dados['computador_id'];
        $stmt->execute();
        header("location:computador.php");
    }

    function excluir($computador_id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from computador WHERE computador_id = :computador_id');
        $stmt->bindParam(':computador_id', $computador_id, PDO::PARAM_INT);
        $computador_idD = $computador_id;
        $stmt->execute();
        header("location:computador.php");
    
    }


    // Busca um item pelo código no BD
    function buscarDados($computador_id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM computador WHERE computador_id = $computador_id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['computador_id'] = $linha['computador_id'];
            $dados['tipocomp'] = $linha['tipocomp'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['computador_id'] = $_POST['computador_id'];
        $dados['tipocomp'] = $_POST['tipocomp'];
        return $dados;
    }

?>