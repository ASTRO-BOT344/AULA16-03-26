<?php
// Cria o arquivo banco.sqlite magicamente na raiz do projeto
try {
    $pdo = new PDO("sqlite:banco.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria a tabela
    $pdo->exec("CREATE TABLE IF NOT EXISTS tbl_maquinas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        status_operacional TEXT DEFAULT 'Ativo',
        data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
        data_falha DATETIME,
        nivel_severidade INTEGER
    )");

    // Verifica se já tem máquinas. Se não tiver, insere as 3 de teste
    $stmt = $pdo->query("SELECT COUNT(*) FROM tbl_maquinas");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO tbl_maquinas (nome, status_operacional) VALUES 
        ('Máquina 1: Impressora', 'Ativo'),
        ('Máquina 2: Servidor', 'Ativo'),
        ('Máquina 3: Internet', 'Ativo')");
        echo "<h1 style='color:green; font-family:sans-serif;'>✅ Sucesso Absoluto!</h1> 
              <p style='font-family:sans-serif;'>Banco SQLite criado e máquinas inseridas. Você já pode acessar o sistema!</p>";
    } else {
        echo "<h1 style='font-family:sans-serif;'>Tudo certo!</h1> 
              <p style='font-family:sans-serif;'>O banco de dados já estava pronto para uso.</p>";
    }

} catch (PDOException $e) {
    echo "Erro ao criar o banco: " . $e->getMessage();
}
?>