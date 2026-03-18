<?php
try {
    // Conexão PDO via SQLite apontando para a raiz
    $pdo = new PDO("sqlite:../banco.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $severidade = $_POST['severidade'];
        $dataHoraAtual = date('Y-m-d H:i:s'); 

        // Atualiza o banco de dados
        $sql = "UPDATE tbl_maquinas 
                SET status_operacional = 'Falha Crítica', 
                    data_falha = :data_falha, 
                    nivel_severidade = :severidade 
                WHERE id = :id";
                
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'data_falha' => $dataHoraAtual,
            'severidade' => $severidade,
            'id' => $id
        ]);

        echo json_encode(['sucesso' => true]);
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Dados não enviados']);
    }

} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
}
?>