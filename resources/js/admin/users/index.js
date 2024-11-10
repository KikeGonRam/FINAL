// scripts.js
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            if (!confirm('¿Estás seguro de eliminar este usuario?')) {
                e.preventDefault();
            }
        });
    });
});
