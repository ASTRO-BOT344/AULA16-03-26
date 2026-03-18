// Arquivo: dados_grafico.php
<?php
$conn = new mysqli("localhost", "usuario", "senha", "banco");

$sql = "SELECT status, COUNT(*) as total FROM maquinas GROUP BY status";
$result = $conn->query($sql);

$dados = [];
while($row = $result->fetch_assoc()) {
    $dados[$row['status']] = $row['total'];
}

// Isso transforma o array do PHP em algo como {"Operando": 10, "Falha": 2}
echo json_encode($dados); 
?>