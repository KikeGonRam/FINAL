// login.js

document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.querySelector('form');
    
    loginForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Evitar que el formulario se envíe de manera predeterminada

        const email = document.getElementById('email');
        const password = document.getElementById('password');

        // Realizar validaciones simples (aquí puedes agregar más validaciones)
        if (!email.value || !password.value) {
            alert('Por favor, completa todos los campos.');
            return;
        }

        // Mostrar animación al hacer login (puedes agregar un spinner o algo visual)
        const submitButton = document.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = 'Cargando...';

        // Aquí podrías enviar el formulario de manera AJAX o de forma tradicional
        // Ejemplo de un retraso para simular la solicitud (Elimina esto si vas a hacer un POST real)
        setTimeout(function () {
            loginForm.submit(); // Si todo es válido, se envía el formulario
        }, 2000);
    });
});
