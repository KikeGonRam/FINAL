// Bienvenido a DARKETO

document.addEventListener("DOMContentLoaded", function() {
    // Validar que los campos no estén vacíos
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            let valid = true;
            form.querySelectorAll('input').forEach(input => {
                if (input.value === '') {
                    valid = false;
                    input.style.borderColor = 'red';
                }
            });

            if (!valid) {
                event.preventDefault();  // Prevenir el envío del formulario
                alert('Por favor, completa todos los campos');
            }
        });
    });
});
