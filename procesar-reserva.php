<?php
include 'db.php';

// Habilitar errores para depuración en desarrollo (Desactivar en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Variables para el mensaje y estado del formulario
$mensaje = '';
$estado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $tour_id = intval($_POST['tour_id']);
    $cliente_nombre = htmlspecialchars(trim($_POST['cliente_nombre']));
    $cliente_email = filter_var($_POST['cliente_email'], FILTER_SANITIZE_EMAIL);
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $fecha_reserva = $_POST['fecha_reserva'];
    $cantidad_personas = intval($_POST['cantidad_personas']);
    $cantidad_ninos = intval($_POST['cantidad_ninos']);
    $estado_reserva = 'pendiente'; // Estado inicial por defecto

    // Validar que todos los campos requeridos estén completos
    if ($tour_id && $cliente_nombre && $cliente_email && $telefono && $fecha_reserva) {
        // Preparar la consulta para insertar la reserva
        $query = $conn->prepare(
            "INSERT INTO reservas (tour_id, cliente_nombre, cliente_email, telefono, fecha_reserva, cantidad_personas, cantidad_ninos, estado) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $query->bind_param("issssiis", $tour_id, $cliente_nombre, $cliente_email, $telefono, $fecha_reserva, $cantidad_personas, $cantidad_ninos, $estado_reserva);

        // Ejecutar la consulta y verificar el resultado
        if ($query->execute()) {
            $mensaje = "¡Reserva realizada con éxito! Tu estado inicial es: $estado_reserva.";
            $estado = 'success';
        } else {
            $mensaje = "Ocurrió un error al guardar tu reserva. Por favor, inténtalo nuevamente.";
            $estado = 'error';
        }
    } else {
        $mensaje = "Por favor, completa todos los campos correctamente.";
        $estado = 'error';
    }
} else {
    $mensaje = "Acceso no permitido.";
    $estado = 'error';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Reserva</title>
    <link rel="stylesheet" href="css/procesar-reserva.css">
</head>
<body>
    <?php include 'header-index.php'; ?>

    <div class="container">
        <div class="mensaje <?= $estado; ?>">
            <h1><?= htmlspecialchars($mensaje); ?></h1>
            <a href="index.php" class="btn">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>
