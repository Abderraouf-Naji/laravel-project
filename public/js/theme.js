// public/js/theme.js

// Vérifie si le mode sombre est déjà activé dans localStorage
if (localStorage.getItem('dark-mode') === 'enabled') {
    document.body.classList.add('dark-mode');
    const themeToggle = document.getElementById('themeToggle');
    themeToggle.innerHTML = '<i class="fas fa-sun"></i> Activer le mode clair';
}

// Gestionnaire d'événement pour le bouton de basculement du thème
document.getElementById('themeToggle').addEventListener('click', function () {
    const themeToggle = this;

    // Bascule entre le mode sombre et le mode clair
    document.body.classList.toggle('dark-mode');

    // Change l'icône et le texte en fonction du mode activé
    if (document.body.classList.contains('dark-mode')) {
        themeToggle.innerHTML = '<i class="fas fa-sun"></i> mode sombre';
        localStorage.setItem('dark-mode', 'enabled');
    } else {
        themeToggle.innerHTML = '<i class="fas fa-moon"></i> mode claire';
        localStorage.removeItem('dark-mode');
    }
});
