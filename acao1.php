<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao1 entra aqui
    $acao1 = isset($_GET['acao1']) ? $_GET['acao1'] : "";
    if ($acao1 == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    }

    // Se foi enviado via POST para acao1 entra aqui
    $acao1 = isset($_POST['acao1']) ? $_POST['acao1'] : "";
    if ($acao1 == "salvar"){
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
        $tipocomp = isset($_POST['tipocomp']) ? $_POST['tipocomp'] : "";
        $stmt = $pdo->prepare('INSERT INTO computador (tipocomp) VALUES(:tipocomp)');
        $stmt->bindParam(':tipocomp', $tipocomp, PDO::PARAM_STR);
        $tipocomp = $dados['tipocomp'];
        $stmt->execute();
        header("location:computador.php");
        
    }

    function editar($id){
        $tipocomp = isset($_POST['tipocomp']) ? $_POST['tipocomp'] : "";
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE `ativprog3`.`computador` SET `tipocomp` = :tipocomp WHERE (`id` = :id);');
        $stmt->bindParam(':tipocomp', $tipocomp, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $tipocomp = $dados['tipocomp'];
        $id = $dados['id'];
        $stmt->execute();
        header("location:computador.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from computador WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:computador.php");
    
    }


    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM computador WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['tipocomp'] = $linha['tipocomp'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['tipocomp'] = $_POST['tipocomp'];
        return $dados;
    }

?>