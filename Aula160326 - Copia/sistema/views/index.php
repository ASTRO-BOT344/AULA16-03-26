<?php
try {
    // Conexão PDO apontando para o arquivo SQLite na pasta anterior (raiz)
    $pdo = new PDO("sqlite:../banco.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta (SELECT) para buscar as máquinas
    $stmt = $pdo->query("SELECT * FROM tbl_maquinas");
    $maquinas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro de conexão com o Banco de Dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Resende-Tech</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #FFFFFF; color: #333; line-height: 1.6; }
        header { background-color: #67c6e5; color: white; padding: 2rem 1rem; text-align: center; margin-bottom: 2rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .container { max-width: 1000px; margin: 0 auto; padding: 0 20px; }
        h2 { margin-bottom: 1.5rem; color: #444; border-left: 5px solid #67c6e5; padding-left: 10px; }
        .grid-maquinas { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 3rem; }
        .card { background: #fff; border: 1px solid #eee; border-radius: 10px; padding: 20px; flex: 1 1 calc(33.333% - 20px); min-width: 250px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); transition: transform 0.3s ease; }
        .card:hover { transform: translateY(-5px); }
        .card h3 { margin-bottom: 10px; font-size: 1.2rem; }
        .status { display: inline-block; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: bold; }
        .operacao { background-color: #d1fae5; color: #065f46; } 
        .manutencao { background-color: #fef3c7; color: #92400e; } 
        .falha { background-color: #fee2e2; color: #991b1b; } 
        .setor-info { background-color: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px dashed #67c6e5; }
        button { padding: 8px 15px; background-color: #e53e3e; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 15px; font-weight: bold; transition: background 0.3s;}
        button:hover { background-color: #c53030; }
    </style>
</head>
<body>

    <header>
        <h1>Monitor de Sistemas Resende-Tech</h1>
        <p>Operação Zero em andamento</p>
    </header>

    <main class="container">
        <section>
            <h2>Setor das Máquinas</h2>
            <div class="setor-info">
                <p><strong>Configuração Atual:</strong> Impressoras, Servidores e Infraestrutura de Rede.</p>
            </div>
        </section>

        <section>
            <h2>Status em Tempo Real</h2>
            <div class="grid-maquinas">
                <?php if (!empty($maquinas)): ?>
                    <?php foreach ($maquinas as $maq): ?>
                        <div class="card" id="card-<?= $maq['id'] ?>">
                            <h3><?= htmlspecialchars($maq['nome']) ?></h3>
                            
                            <?php 
                                $classe = ($maq['status_operacional'] == 'Ativo' || $maq['status_operacional'] == 'Em operação') ? 'operacao' : 'falha';
                            ?>
                            
                            <span class="status <?= $classe ?>" id="status-<?= $maq['id'] ?>">
                                ● <?= htmlspecialchars($maq['status_operacional']) ?>
                            </span>
                            <br>
                            <button onclick="simularFalha(<?= $maq['id'] ?>)">Simular Falha</button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Nenhuma máquina encontrada no banco de dados.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script src="../assets/js/script.js"></script>

</body>
</html>