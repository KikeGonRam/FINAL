
<div class="container">
    <div class="alert alert-warning">
        <strong>Atención:</strong> La opción de pago con PayPal no está disponible en este momento. Por favor, contacte al administrador en <strong>admin@darketo.com</strong> para más información.
    </div>
    <a href="{{ route('cart.view') }}" class="btn btn-primary">Volver al carrito</a>
</div>

<style>

.container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f8f9fa; /* Color de fondo claro */
    border: 1px solid #dee2e6; /* Borde gris claro */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra sutil */
}

.alert {
    font-family: Arial, sans-serif; /* Fuente legible */
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 20px;
    padding: 15px;
    background-color: #fff3cd; /* Fondo amarillo claro */
    color: #856404; /* Texto amarillo oscuro */
    border: 1px solid #ffeeba; /* Borde amarillo */
    border-radius: 5px;
}

.alert strong {
    color: #7a5902; /* Texto más oscuro para destacar */
}

.btn-primary {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff; /* Azul Bootstrap */
    border: none;
    border-radius: 5px;
    text-decoration: none;
    text-align: center;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3; /* Azul más oscuro al pasar el cursor */
}

</style>