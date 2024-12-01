// public/js/theme.js

// Vérifie si le mode sombre est déjà activé dans localStorage
if (localStorage.getItem('dark-mode') === 'enabled') {
    document.body.classList.add('dark-mode');
    document.getElementById('themeToggle').textContent = 'Activer le mode clair';
}

document.getElementById('themeToggle').addEventListener('click', function() {
    // Bascule entre le mode sombre et le mode clair
    document.body.classList.toggle('dark-mode');

    // Change le texte du bouton
    if (document.body.classList.contains('dark-mode')) {
        this.textContent = 'Activer le mode clair';
        localStorage.setItem('dark-mode', 'enabled');
    } else {
        this.textContent = 'Activer le mode sombre';
        localStorage.removeItem('dark-mode');
    }
});
