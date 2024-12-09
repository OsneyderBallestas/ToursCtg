<?php
include 'db.php';

// Verificar si se recibe el ID del tour
if (isset($_GET['tour_id'])) {
    $tour_id = intval($_GET['tour_id']); // Asegurar que el ID es un entero

    // Consulta para obtener los datos del tour
    $query = "SELECT * FROM tours WHERE id = $tour_id AND estado = 1";
    $result = $conn->query($query);

    // Verificar si el tour existe
    if ($result->num_rows > 0) {
        $tour = $result->fetch_assoc(); // Obtener los datos del tour
    } else {
        echo "<p>El tour que buscas no está disponible.</p>";
        exit;
    }
} else {
    echo "<p>No se especificó un tour válido.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Tour: <?= htmlspecialchars($tour['titulo']); ?></title>
    <link rel="stylesheet" href="css/detalle-tour.css">
</head>
<body>
    <div class="tour-detail-container">
        <!-- Banner del tour -->
        <div class="tour-banner" style="background-image: url('<?= htmlspecialchars($tour['banner']); ?>');">
    <h1><?= htmlspecialchars($tour['titulo']); ?></h1>
</div>


        <!-- Descripción General -->
        <h2>Descripción General</h2>
        <p><?= nl2br(htmlspecialchars($tour['descripcion_general'])); ?></p>

        <!-- Incluye -->
        <h2>Incluye</h2>
        <ul>
            <?php foreach (explode("\n", $tour['incluye']) as $item): ?>
                <li><?= htmlspecialchars($item); ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- No Incluye -->
        <h2>No Incluye</h2>
        <ul>
            <?php foreach (explode("\n", $tour['no_incluye']) as $item): ?>
                <li><?= htmlspecialchars($item); ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Horario -->
        <h2>Horario</h2>
        <p><?= htmlspecialchars($tour['horario']); ?></p>

        <!-- Duración -->
        <h2>Duración</h2>
        <p><?= htmlspecialchars($tour['duracion']); ?></p>

        <!-- Punto de Encuentro -->
        <h2>Punto de Encuentro</h2>
        <p><?= nl2br(htmlspecialchars($tour['punto_encuentro'])); ?></p>

        <!-- Recomendaciones -->
        <h2>Recomendaciones</h2>
        <p><?= nl2br(htmlspecialchars($tour['recomendaciones'])); ?></p>

        <!-- Precio por Persona -->
        <h2>Precio por Persona</h2>
        <p><strong>$<?= number_format($tour['precio_por_persona'], 2, ',', '.'); ?> COP</strong></p>
    </div>
</body>
</html>
