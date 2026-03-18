/**
 * Lógica de Reatividade - Monitor Resende-Tech
 */

function simularFalha(idMaquina) {
    const formData = new FormData();
    formData.append('id', idMaquina);
    formData.append('severidade', 3);

    // Apontando para o arquivo PHP correto na pasta de controllers
    fetch('../controllers/atualizar_falha.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            alert("Atenção! Entropia detectada na máquina " + idMaquina);
            
            let statusSpan = document.getElementById('status-' + idMaquina);
            
            if (statusSpan) {
                statusSpan.className = 'status falha'; 
                statusSpan.innerText = '● Falha Crítica';
            }
        } else {
            alert("Erro ao registrar a falha: " + (data.erro || "Falha no servidor."));
        }
    })
    .catch(error => {
        console.error('Erro de requisição:', error);
        alert("Erro de comunicação com o servidor.");
    });
}