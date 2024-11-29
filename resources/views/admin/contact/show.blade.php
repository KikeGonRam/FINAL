<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de Contacto</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #1a1c2c 0%, #2a3042 100%);
            color: #e2e8f0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .back-link {
            color: #818cf8;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #6366f1;
        }

        .card {
            background: rgba(31, 41, 55, 0.8);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-title {
            color: #f3f4f6;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .info-row {
            display: flex;
            margin-bottom: 0.75rem;
        }

        .info-label {
            font-weight: 600;
            min-width: 160px;
            color: #9ca3af;
        }

        .info-value {
            color: #e2e8f0;
        }

        .message-box {
            background: rgba(17, 24, 39, 0.4);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            background: rgba(52, 211, 153, 0.2);
            color: #34d399;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #4338ca;
            transform: translateY(-1px);
        }

        @media (max-width: 640px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .info-row {
                flex-direction: column;
            }

            .info-label {
                margin-bottom: 0.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="section-title" style="font-size: 1.875rem; margin: 0;">Detalles de Contacto</h1>
            <a href="{{ route('admin.contact.index')}}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                <span>Volver a la lista de contactos</span>
            </a>
        </div>

        <div class="card">
            <div class="section">
                <h2 class="section-title">Información del Contacto</h2>
                <div class="info-row">
                    <span class="info-label">Nombre:</span>
                    <span class="info-value">{{ $contact->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Correo Electrónico:</span>
                    <span class="info-value">{{ $contact->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Mensaje:</span>
                </div>
                <div class="message-box">
                    <span class="info-value">{{ $contact->details }}</span>
                </div>
            </div>

            <div class="section">
                <h3 class="section-title">Detalles Adicionales</h3>
                <div class="info-row">
                    <span class="info-label">Fecha de Contacto:</span>
                    <span class="info-value">{{ $contact->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Estado:</span>
                    <span class="status-badge">{{ $contact->status }}</span>
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('admin.contact.index')}}" class="btn">
                    <i class="fas fa-list"></i>
                    <span>Volver a la lista</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>