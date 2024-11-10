document.addEventListener("DOMContentLoaded", function () {
    // Animaciones del menú
    const sidebarLinks = document.querySelectorAll(".sidebar a");
    sidebarLinks.forEach(link => {
        link.addEventListener("mouseover", function () {
            this.style.backgroundColor = "#e44d26";
            this.style.transform = "translateX(10px)"; // Añadido movimiento suave al pasar el ratón
        });

        link.addEventListener("mouseout", function () {
            this.style.backgroundColor = "";
            this.style.transform = "translateX(0)"; // Vuelve a la posición original
        });
    });

    // Efecto de deslizamiento en la barra lateral (sidebar) al cargar
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.animation = "slideIn 0.5s ease-out";  // Aplica la animación al cargar

    // Animación del título de bienvenida
    const header = document.querySelector('.header h1');
    if (header) {
        let i = 0;
        const text = 'Bienvenido al Panel de Usuario de DARKETO';
        const typingEffect = setInterval(function () {
            header.textContent += text[i];
            i++;
            if (i === text.length) clearInterval(typingEffect);
        }, 100); // Velocidad de la animación de tipeo
    }
});
