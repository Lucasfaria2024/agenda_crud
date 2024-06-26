<?php
// incluir a conexão na pagina e todo o seu conteudo
include 'conexao.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    echo "EU QUERO DELETAR ALGUEM DO MEU SISTEMA";
    exit;
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
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cadastrar.php">Cadastrar</a></li>
        </ul>
    </nav>
    </header>
    <section>
        <h2>Lista de Contatos</h2>
        <table border="1">
            <thead>
                <tr>
                   <td>ID</td>
                   <td>Nome</td>
                   <td>Sobrenome</td>
                   <td>Nascimento</td>
                   <td>Endereço</td>
                   <td>Telefone</td>
                   <td>Ações</td>
                </tr>
            </thead>
            <tbody>
            <?php
                $conexaoComBanco = abrirBanco();
                $sql = "SELECT id, nome, sobrenome, nascimento, endereco, telefone
                FROM pessoas";
                $result = $conexaoComBanco->query($sql);
                //$registros = $result->fetch_assoc();
                //veririfcar sae a query retornou registros
                if ($result->num_rows > 0){
                   // tem registro no banco
                   while ($registro = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= $registro["id"] ?></td>
                        <td><?= $registro["nome"] ?></td>
                        <td><?= $registro["sobrenome"] ?></td>
                        <td><?= date("d/m/y", strtotime($registro['nascimento']))?></td>
                        <td><?= $registro["endereco"] ?></td>
                        <td><?= $registro["telefone"] ?></td>
                        <td>
                            <a href="?acao=editar&id"><button>Editar</button></a>
                            <a href="?acao=excluir&id=<?= $registro["id"] ?>"
                            onclick="return confirm('Tem certeza de que quer viver para Cristo')">
                            <button>Excluir</button></a>
                        </td>
                    </tr>
                   <?php
                   }
                } else {
                ?>  
                    <tr>
                   <td colspan='7'>Nenhum registro no banco de dados</td>
                   </tr>
                <?php
                }


            ?>

            </tbody>
        </table>

    </section>
    </body>
    </html>