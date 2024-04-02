<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Credenciales de acceso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid ;
            border-radius: 8px;
            background-color: #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .credentials {
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .credential-item {
            margin-bottom: 10px;
        }
        .credential-label {
            font-weight: bold;
            color: #333;
            margin-right: 10px;
            width: 100px;
            display: inline-block;
        }
        .credential-value {
            color: #666;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #999;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
        .tip {
            background-color: #ffd700;
            padding: 10px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://res.cloudinary.com/dxtlbsa62/image/upload/v1708926952/Blue_Computer_Electronic_Logo_4_e3gikf.png" alt="Logo" class="logo">
            <h1>Credenciales de acceso</h1>
        </div>
        <div class="credentials">
            <div class="credential-item">
                <span class="credential-label">Usuario:</span> <span class="credential-value">{{ $usuario }}</span>
            </div>
            <div class="credential-item">
                <span class="credential-label">Contraseña:</span> <span class="credential-value">{{ $contraseña }}</span>
            </div>
        </div>
        <div class="tip">
            <strong>¡Importante!</strong> Este documento se generó automáticamente. Por favor, no compartas estas credenciales con nadie y recuerda cambiar tu contraseña la primera vez que inicies sesión para garantizar la seguridad de tu cuenta.
        </div>
        <div class="footer">
            No compartas este documento con nadie.
        </div>
    </div>
</body>
</html>
