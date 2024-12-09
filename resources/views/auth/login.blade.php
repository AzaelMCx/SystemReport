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
            background-image: url('images/sesesp.png');
            background-size: 59% auto;
            background-repeat: no-repeat;
            background-position: center;
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
            color: #f0f0f0e7;
        }
        /* Título */
        .login-header {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #3b3d34ab;
        }
        /* Estilos para los inputs */
        .login-card input[type="email"],
        .login-card input[type="password"],
        .login-card input[type="text"] {
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 0.75rem;
            width: 100%;
            border-radius: 8px;
            margin-bottom: 1rem;
            color: #181b18;
            outline: none;
            transition: background-color 0.3s;
        }
        .login-card input[type="email"]:focus,
        .login-card input[type="password"]:focus,
        .login-card input[type="text"]:focus {
            background-color: rgba(255, 255, 255, 0.3);
        }
        /* Botón de inicio de sesión */
        .login-button {
            background-color: #3d39309a;
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
        /* Botón de registro */
        .register-button {
            background-color: #3d39309a;
            border: none;
            color: #ffffff;
            font-weight: bold;
            padding: 0.75rem;
            width: 100%;
            border-radius: 8px;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }
        .register-button:hover {
            background-color: #45a049;
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
        /* Contenedor de contraseña con ícono */
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
        }
        .password-toggle svg {
            width: 24px;
            height: 24px;
            fill: #3b3d34ab;
        }
    </style>
</head>
<body>

    <div class="login-card">

        <div class="login-header">Iniciar Sesion</div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <label for="email" style="color:#1a1a2e57; font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold;">Correo Electrónico</label>
            <input type="email" id="email" name="email" required autofocus placeholder="Email">
            
            <label for="password" style="color:#1a1a2e57; font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold;">Contraseña</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required placeholder="Password">
                <button type="button" class="password-toggle" onclick="togglePasswordVisibility()">
                    <!-- Ícono de mostrar -->
                    <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 4c4.418 0 8 3.582 8 8s-3.582 8-8 8-8-3.582-8-8 3.582-8 8-8zm0 2c-3.308 0-6 2.692-6 6s2.692 6 6 6 6-2.692 6-6-2.692-6-6-6zM12 9c.26 0 .52.098.707.293.187.195.293.453.293.707s-.106.512-.293.707c-.187.195-.447.293-.707.293s-.52-.098-.707-.293c-.187-.195-.293-.453-.293-.707s.106-.512.293-.707c.187-.195.447-.293.707-.293z"/>
                    </svg>
                    <!-- Ícono de ocultar -->
                    <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                        <path d="M12 4c4.418 0 8 3.582 8 8s-3.582 8-8 8-8-3.582-8-8 3.582-8 8-8zm3.707 6.707c.195.187.293.447.293.707s-.098.52-.293.707l-5 5c-.195.195-.453.293-.707.293s-.512-.098-.707-.293l-1-1c-.195-.195-.293-.453-.293-.707s.098-.52.293-.707l5-5c.195-.195.453-.293.707-.293s.52.098.707.293l1 1z"/>
                    </svg>
                </button>
            </div>
            
            <button type="submit" class="login-button">Iniciar Sesión</button>
        </form>

        <!-- Botón de Registro -->
        <form action="{{ route('register') }}" method="GET">
            <button type="submit" class="register-button">Regístrate</button>
        </form>
        
        <div class="login-footer">
            <p>¿Olvidaste tu contraseña? <a href="{{ route('password.request') }}">Recuperarla</a></p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const iconEye = document.getElementById('icon-eye');
            const iconEyeOff = document.getElementById('icon-eye-off');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                iconEye.style.display = 'none';
                iconEyeOff.style.display = 'block';
            } else {
                passwordInput.type = 'password';
                iconEye.style.display = 'block';
                iconEyeOff.style.display = 'none';
            }
        }
    </script>
</body>
</html>
