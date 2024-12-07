<?php
$host = 'localhost';  // Servidor de base de datos
$user = 'root';       // Usuario de la base de datos
$password = '';       // Contraseña del usuario
$database = 'tours_db'; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar si hay errores
if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error); // Registra el error en un archivo de log
    die("Lo sentimos, no se puede conectar a la base de datos en este momento."); // Mensaje genérico
}
?>
