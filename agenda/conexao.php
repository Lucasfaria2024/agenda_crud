
<?php

// criar constantes para armazenar as informações de acesso ao banco de dados
define ("DB_HOST", "localhost");
define ("DB_USER", "root");
define ("DB_PASS", "");
define ("DB_NAME", "agenda");
define ("DB_PORT", "3306");

/* 
*abre uma conexao com o banco de dados e retorna um objeto de conexao
*@return mysqli - retorna o objeto de conexao mysql.
 */
function abrirBanco() {
    $conexaoComBanco = new mysqli(DB_HOST,DB_USER, DB_PASS,DB_NAME,DB_PORT);

    // verificar se ocorreu um erro
    if ($conexaoComBanco->connect_error) {
        die("falha na conexão" . $conexaoComBanco->connect_error);  
    }
    return $conexaoComBanco;
}

/*
 *fecha a conexão com o banco de dados
 */
function fecharBanco($conexaoComBanco) {
    $conexaoComBanco->close();
}

?>