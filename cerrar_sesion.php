<?php
session_start();
session_destroy(); // Destruir la sesión
header("Location: index.php"); // Redirigir al archivo index.php
exit();
?>