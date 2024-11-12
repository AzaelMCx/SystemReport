<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - SystemReport</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Fondo oscuro con textura */
        body {
            background: #1a1a2e;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #ffffff;
            font-family: Arial, sans-serif;
        }
        /* Tarjeta con efecto glassmorphism */
        .login-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            max-width: 380px;
            width: 100%;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #f0f0f0;
        }
        /* Título */
        .login-header {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #ffd369;
        }
        /* Estilos para los inputs */
        .login-card input[type="email"],
        .login-card input[type="password"] {
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 0.75rem;
            width: 100%;
            border-radius: 8px;
            margin-bottom: 1rem;
            color: #ffffff;
            outline: none;
            transition: background-color 0.3s;
        }
        .login-card input[type="email"]:focus,
        .login-card input[type="password"]:focus {
            background-color: rgba(255, 255, 255, 0.3);
        }
        /* Botón de inicio de sesión */
        .login-button {
            background-color: #ffd369;
            border: none;
            color: #1a1a2e;
            font-weight: bold;
            padding: 0.75rem;
            width: 100%;
            border-radius: 8px;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }
        .login-button:hover {
            background-color: #e6b852;
        }
        /* Pie de página con enlace */
        .login-footer {
            text-align: center;
            font-size: 0.9rem;
            color: #b0b0b0;
            margin-top: 1.5rem;
        }
        .login-footer a {
            color: #ffd369;
            text-decoration: none;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">Iniciar Sesion</div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required autofocus placeholder="Ingresa tu correo">
            
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required placeholder="Ingresa tu contraseña">
            
            <button type="submit" class="login-button">Iniciar Sesión</button>
        </form>
        
        <div class="login-footer">
            <p>¿Olvidaste tu contraseña? <a href="{{ route('password.request') }}">Recuperarla</a></p>
        </div>
    </div>
</body>
</html>
