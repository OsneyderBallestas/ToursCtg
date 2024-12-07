<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Header Principal</title>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">   
</head>
<body>
    <header class="header">
        <div class="contenedor">
            <nav class="navegacion">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="#tours">Tours</a></li>
                    <li><a href="#nosotros">Nosotros</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </nav>
            <a href="index.php" class="logo">
                <img src="img/logo-azul.svg" alt="Logotipo">
            </a>
            <div class="login">
                <a href="inicio_sesion.php">
                    <i class="bi bi-person-circle"></i>
                    Iniciar sesión
                </a>
            </div>
            <div class="contacto-header">
                <a href="">Contacto</a>
            </div>
        </div>
    </header>



    <!-- Header para la versión móvil -->
    <div class="header-movil">
        <!-- Contenedor del logotipo en la versión móvil -->
        <div class="logo-movil">
            <a href="index.php" class="logo-link">
                <img src="img/logo-azul.svg" alt="Logotipo Completo">
            </a>
        </div>
        <!-- Icono de menú hamburguesa para abrir el menú en la versión móvil -->
        <div class="menu-icon-movil" id="btn-menu-movil">
            <i class='bx bx-menu'></i> <!-- Icono de menú hamburguesa -->
        </div>
    </div>

    <!-- Menú desplegable para móvil -->
    <nav class="menu-desplegable-movil" id="menu-movil">
        <!-- Icono para cerrar el menú en la versión móvil -->
        <div class="close-icon-movil" id="btn-close-movil">
          <i class='bx bx-x'></i> <!-- Icono de cerrar -->
        </div>
        <!-- Lista de opciones del menú en móvil -->
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#tours">Tours</a></li>
            <li><a href="#nosotros">Nosotros</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="inicio_sesion.php">iniciar sesión</a></li>
        </ul>
    </nav>
    <script src="js/menuMovil.js"></script>
    <script src="js/stickyMenu.js"></script>
</body>
</html>
