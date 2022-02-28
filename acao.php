<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
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
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
        $idade = isset($_POST['idade']) ? $_POST['idade'] : "";
        $tempo = isset($_POST['tempo']) ? $_POST['tempo'] : "";
        $stmt = $pdo->prepare('INSERT INTO usuario (name, cpf, idade, tempo) VALUES(:name, :cpf, :idade, :tempo)');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':idade', $idade, PDO::PARAM_STR);
        $stmt->bindParam(':tempo', $tempo, PDO::PARAM_STR);
        $name = $dados['name'];
        $cpf = $dados['cpf'];
        $idade = $dados['idade'];
        $tempo = $dados['tempo'];
        $stmt->execute();
        header("location:usuario.php");
        
    }

    function editar($id){
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
        $idade = isset($_POST['idade']) ? $_POST['idade'] : "";
        $tempo = isset($_POST['tempo']) ? $_POST['tempo'] : "";
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE `ativprog3`.`usuario` SET `name` = :name, `cpf` = :cpf, `idade` = :idade, `tempo` = :tempo WHERE (`id` = :id);');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':idade', $idade, PDO::PARAM_STR);
        $stmt->bindParam(':tempo', $tempo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $name = $dados['name'];
        $cpf = $dados['cpf'];
        $idade = $dados['idade'];
        $tempo = $dados['tempo'];
        $id = $dados['id'];
        $stmt->execute();
        header("location:usuario.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from usuario WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:usuario.php");
        
        //echo "Excluir".$id;

    }


    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM usuario WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['name'] = $linha['name'];
            $dados['cpf'] = $linha['cpf'];
            $dados['idade'] = $linha['idade'];
            $dados['tempo'] = $linha['tempo'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['name'] = $_POST['name'];
        $dados['cpf'] = $_POST['cpf'];
        $dados['idade'] = $_POST['idade'];
        $dados['tempo'] = $_POST['tempo'];
        return $dados;
    }

?>