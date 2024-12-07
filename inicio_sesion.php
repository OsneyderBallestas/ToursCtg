<?php
session_start();
// Verifica si el usuario ya está logueado
if (isset($_SESSION['id_usuario'])) {
    header('Location: admin.php'); // Redirige al panel de administración si ya está logueado
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/inicio-sesion.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
     <!-- Incluir el header -->
     <?php include 'header-index.php'; ?>

    <div class="contenedor-login">
        <h1>Iniciar Sesión</h1>
        <form action="procesar_inicio_sesion.php" method="POST">
            <!-- Campo de usuario -->
            <input type="text" name="usuario" placeholder="Nombre de usuario o correo electrónico" required>

            <!-- Campo de contraseña con ícono -->
            <div class="campo-password">
                <input type="password" name="contrasena" id="password" placeholder="Contraseña" required>
                <span id="toggle-password" class="icono-password">
                    <i class="bi bi-eye"></i> <!-- Ícono inicial -->
                </span>
            </div>

            <!-- Botón de envío -->
            <button type="submit">Ingresar</button>
        </form>
    </div>

    <script>
        // Obtener elementos
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('toggle-password');
        const icon = togglePassword.querySelector('i');

        // Agregar evento de clic al ícono
        togglePassword.addEventListener('click', () => {
            // Alternar el tipo de input entre "password" y "text"
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text'; // Mostrar la contraseña
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash'); // Cambiar el ícono a "ocultar"
            } else {
                passwordInput.type = 'password'; // Ocultar la contraseña
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye'); // Cambiar el ícono a "mostrar"
            }
        });
    </script>
</body>
</html>
