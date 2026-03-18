const btn = document.getElementById('theme-toggle');
const currentTheme = localStorage.getItem('theme');

// 1. Verifica se o usuário já tinha uma preferência salva
if (currentTheme === 'dark') {
  document.body.classList.add('dark-mode');
}

// 2. Escuta o clique no botão
btn.addEventListener('click', () => {
  // Alterna a classe .dark-mode
  document.body.classList.toggle('dark-mode');
  
  // 3. Salva a escolha atual no localStorage
  let theme = 'light';
  if (document.body.classList.contains('dark-mode')) {
    theme = 'dark';
  }
  localStorage.setItem('theme', theme);
});