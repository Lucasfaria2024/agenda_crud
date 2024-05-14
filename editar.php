<?php
    include_once 'conexao.php';
    include_once 'funcoes.php';

    if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
        
        //if ternário
        $id = isset($_GET['id']) ? $_GET['id'] : 0;  1;

        //Vamos abrir a conexao com o banco de dados
        $conexaoComBanco = abrirBanco();
        
        $sql = "Select * FROM pessoas WHERE id = ?" ;
        //preparar o SQL para consultar o id no banco de dados
        $pegarDados = $conexaoComBanco->prepare($sql);
        //Substituir o ??????
        $pegarDados->bind_param("i", $id);
        //Executar o SQL que preparamos
        $pegarDados->execute();
        $result = $pegarDados->get_result(); 

        if($result->num_rows == 1) {
            $registro = $result->fetch_assoc();
          
        } else {
            echo "Nenhum registro encontrado";
            exit;
        }

        $pegarDados->close();
        fecharBanco($conexaoComBanco);
       
    }

    if ($_SERVER['REQUEST_METODO'] == "POST") {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $nascimento = $_POST['nascimento'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];

        $conexaoComBanco = abrirBanco();

        $sql = "UPDATE pessoas SET nome = '$nome', sobrenome= '$sobrenome',
            nascimento = '$nascimento', endereco = '$endereco', telefone = '$telefone'
            WHERE id = $id";

        if ($conexaoComBanco->query($sql) === TRUE) {
            echo ":) Sucesso ao atualizar o contato :)";
        } else {
            echo ":( Erro ao atualizar o contato :(;
        }

        fecharBanco($conexaoComBanco);
        
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
    <h1>Agenda de Contatos</h1>
    
    <mav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cadastrar.php">Cadastrar</a></li>
        </ul>
    </mav>
    </header>

    <section>
        <h2>Atualizar Contato</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?= $registro['nome'] ?>"required> 

            <label for="sobrenome">Sobrenome</label>
            <input type="text" id="sobrenome" name="sobrenome" value="<?= $registro['sobrenome'] ?>"required> 

            <label for="nascimento">Nascimento</label>
            <input type="date" id="nascimento" name="nascimento"value="<?= $registro['nascimento'] ?>" required> 

            <label for="endereco">Endereco</label>
            <input type="text" id="endereco" name="endereco" value="<?= $registro['endereco'] ?>"required> 

            <label for="telefone">Telefone</label>
            <input type="number" id="telefone" name="telefone" value="<?= $registro['telefone'] ?>"required> 

            <input type="hidden" id="id" name="id" value="<?= $registro['id']?>">
 
            <button type="submit">Atualizar</button>
            
        </form>
    </section>
</body>
</html>