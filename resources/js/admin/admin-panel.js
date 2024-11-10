document.addEventListener("DOMContentLoaded", function() {
    // Agregar iconos a los elementos del menú
    const sidebarLinks = document.querySelectorAll(".sidebar a");

    sidebarLinks.forEach((link) => {
        link.addEventListener("mouseover", function() {
            this.style.backgroundColor = "#e44d26"; // Cambio de color al pasar el ratón
        });

        link.addEventListener("mouseout", function() {
            this.style.backgroundColor = ""; // Vuelve al color original
        });
    });

    // Función para animación del panel de bienvenida (opcional)
    const header = document.querySelector('.header h1');
    if (header) {
        let i = 0;
        const text = 'Bienvenido al Panel de Administración de DARKETO';
        const typingEffect = setInterval(function() {
            header.textContent += text[i];
            i++;
            if (i === text.length) clearInterval(typingEffect);
        }, 100); // Velocidad de la animación
    }
});
