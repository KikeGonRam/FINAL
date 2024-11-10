document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const inputs = document.querySelectorAll("input");

    // Efecto de hover en el botón de login
    const button = form.querySelector("button");
    button.addEventListener("mouseover", function() {
        button.style.backgroundColor = "#d7401f";
    });
    button.addEventListener("mouseout", function() {
        button.style.backgroundColor = "#e44d26";
    });

    // Validación básica de campos al enviar el formulario
    form.addEventListener("submit", function(event) {
        let valid = true;

        // Recorremos todos los campos de entrada para comprobar si están vacíos
        inputs.forEach(input => {
            if (input.value.trim() === "") {
                input.style.borderColor = "#f44336"; // Resalta el borde en rojo
                valid = false;
            } else {
                input.style.borderColor = "#ddd"; // Restaura el borde normal
            }
        });

        if (!valid) {
            event.preventDefault();  // Evitar el envío si algún campo está vacío
            alert("Por favor, complete todos los campos correctamente.");
        }
    });

    // Efecto de escritura en el título (opcional)
    const header = document.querySelector("h2");
    const text = "Iniciar sesión en DARKETO";
    let i = 0;
    const typingEffect = setInterval(function() {
        header.textContent += text[i];
        i++;
        if (i === text.length) clearInterval(typingEffect);
    }, 150); // Velocidad de la animación de escritura
});
