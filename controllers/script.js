// 1. Função que troca as abas (continua a mesma)
function openTab(evt, tabName) {
    let tabContents = document.getElementsByClassName("tab-content");
    for (let i = 0; i < tabContents.length; i++) {
        tabContents[i].classList.remove("active");
    }
    let tabBtns = document.getElementsByClassName("tab-btn");
    for (let i = 0; i < tabBtns.length; i++) {
        tabBtns[i].classList.remove("active");
    }
    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
}

// 2. Função que atualiza os gráficos circulares
function updateCircle(idCircle, idText, percent) {
    const circle = document.getElementById(idCircle);
    const text = document.getElementById(idText);
    
    // Atualiza o texto na tela
    text.innerText = percent + "%";
    
    // Transforma a porcentagem (0 a 100) em graus (0 a 360) para desenhar o círculo
    const degrees = (percent / 100) * 360;
    
    // Pega a cor neon que definimos no HTML (CSS variable --color)
    const color = getComputedStyle(circle).getPropertyValue('--color').trim();
    
    // Desenha o preenchimento do círculo usando conic-gradient
    circle.style.background = `conic-gradient(${color} ${degrees}deg, #0b0f19 ${degrees}deg)`;
}

// 3. Simulação de dados hipotéticos (roda sozinho a cada 2 segundos)
setInterval(() => {
    // Gera um valor aleatório para a CPU (entre 10% e 95%)
    let cpuUsage = Math.floor(Math.random() * (95 - 10 + 1)) + 10;
    updateCircle('cpu-circle', 'cpu-text', cpuUsage);

    // Gera um valor aleatório para a RAM (entre 40% e 85%)
    let ramUsage = Math.floor(Math.random() * (85 - 40 + 1)) + 40;
    updateCircle('ram-circle', 'ram-text', ramUsage);

    // O disco geralmente não muda tanto, vamos variar só um pouco (entre 70% e 75%)
    let diskUsage = Math.floor(Math.random() * (75 - 70 + 1)) + 70;
    updateCircle('disk-circle', 'disk-text', diskUsage);

}, 2000); // 2000 milissegundos = 2 segundos

// Dá a primeira carga nos valores assim que a página abre
updateCircle('cpu-circle', 'cpu-text', 45);
updateCircle('ram-circle', 'ram-text', 60);
updateCircle('disk-circle', 'disk-text', 72);