<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'meu_banco_de_dados'; // O nome do banco que você deu as permissões
$usuario = 'admin';   // O usuário que você acabou de criar
$senha = '';           // A senha que você definiu

try {
    // Cria a conexão usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $usuario, $senha);
    
    // Configura o PDO para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Conexão realizada com sucesso!";
    
} catch (PDOException $e) {
    // Caso ocorra algum erro, a mensagem será exibida aqui
    echo "Erro de conexão: " . $e->getMessage();
}
?>