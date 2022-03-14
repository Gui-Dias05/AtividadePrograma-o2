<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $usuario_id = isset($_GET['usuario_id']) ? $_GET['usuario_id'] : 0;
        excluir($usuario_id);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $usuario_id = isset($_POST['usuario_id']) ? $_POST['usuario_id'] : "";
        if ($usuario_id == 0)
            inserir($usuario_id);
        else
            editar($usuario_id);
    }

    // Métodos para cada operação
    function inserir($usuario_id){
        $dados = dadosForm();
        //var_dump($dados)
        
        $pdo = Conexao::getInstance();
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
        $usuario_idade = isset($_POST['usuario_idade']) ? $_POST['usuario_idade'] : "";
        $tempo = isset($_POST['tempo']) ? $_POST['tempo'] : "";
        $stmt = $pdo->prepare('INSERT INTO usuario (name, cpf, usuario_idade, tempo) VALUES(:name, :cpf, :usuario_idade, :tempo)');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':usuario_idade', $usuario_idade, PDO::PARAM_STR);
        $stmt->bindParam(':tempo', $tempo, PDO::PARAM_STR);
        $name = $dados['name'];
        $cpf = $dados['cpf'];
        $usuario_idade = $dados['usuario_idade'];
        $tempo = $dados['tempo'];
        $stmt->execute();
        header("location:usuario.php");
        
    }

    function editar($usuario_id){
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
        $usuario_idade = isset($_POST['usuario_idade']) ? $_POST['usuario_idade'] : "";
        $tempo = isset($_POST['tempo']) ? $_POST['tempo'] : "";
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE `ativprog3`.`usuario` SET `name` = :name, `cpf` = :cpf, `usuario_idade` = :usuario_idade, `tempo` = :tempo WHERE (`usuario_id` = :usuario_id);');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':usuario_idade', $usuario_idade, PDO::PARAM_STR);
        $stmt->bindParam(':tempo', $tempo, PDO::PARAM_STR);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $name = $dados['name'];
        $cpf = $dados['cpf'];
        $usuario_idade = $dados['usuario_idade'];
        $tempo = $dados['tempo'];
        $usuario_id = $dados['usuario_id'];
        $stmt->execute();
        header("location:usuario.php");
    }

    function excluir($usuario_id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from usuario WHERE usuario_id = :usuario_id');
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $usuario_idD = $usuario_id;
        $stmt->execute();
        header("location:usuario.php");
        
        //echo "Excluir".$usuario_id;

    }


    // Busca um item pelo código no BD
    function buscarDados($usuario_id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM usuario WHERE usuario_id = $usuario_id");
        $dados = array(); 
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['usuario_id'] = $linha['usuario_id'];
            $dados['name'] = $linha['name'];
            $dados['cpf'] = $linha['cpf'];
            $dados['usuario_idade'] = $linha['usuario_idade'];
            $dados['tempo'] = $linha['tempo'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['usuario_id'] = $_POST['usuario_id'];
        $dados['name'] = $_POST['name'];
        $dados['cpf'] = $_POST['cpf'];
        $dados['usuario_idade'] = $_POST['usuario_idade'];
        $dados['tempo'] = $_POST['tempo'];
        return $dados;
    }

?>