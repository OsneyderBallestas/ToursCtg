<?php
include 'db.php';

// Recuperar el ID del tour desde la URL
$tour_id = isset($_GET['tour_id']) ? intval($_GET['tour_id']) : null;

if ($tour_id) {
    // Consultar la información del tour seleccionado
    $query = $conn->query("SELECT * FROM tours WHERE id = $tour_id");
    $tour = $query->fetch_assoc();

    if ($tour): ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reservar Tour - <?= htmlspecialchars($tour['titulo']); ?></title>
            <link rel="stylesheet" href="css/reservacion.css"> <!-- Vincula el archivo CSS -->
        </head>
        <body>
             <!-- Incluir el header -->
    <?php include 'header-index.php'; ?>
            
            <div class="container">
                <h1>Reservar Tour: <?= htmlspecialchars($tour['titulo']); ?></h1>
                <div class="tour-info">
                    <p><strong>Precio:</strong> $<?= number_format($tour['precio'], 0, ',', '.'); ?> COP</p>
                    <p><strong>Descripción:</strong> <?= htmlspecialchars($tour['descripcion']); ?></p>
                </div>

                <form action="procesar-reserva.php" method="POST">
                    <input type="hidden" name="tour_id" value="<?= $tour['id']; ?>">

                    <label for="cliente_nombre">Nombre Completo:</label>
                    <input type="text" id="cliente_nombre" name="cliente_nombre" placeholder="Ingresa tu nombre completo" required>

                    <label for="cliente_email">Correo Electrónico:</label>
                    <input type="email" id="cliente_email" name="cliente_email" placeholder="ejemplo@correo.com" required>

                    <label for="telefono">Número de Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Ingresa tu teléfono" required>

                    <label for="fecha_reserva">Fecha de la Reserva:</label>
                    <input type="date" id="fecha_reserva" name="fecha_reserva" required>

                    <label for="cantidad_personas">Cantidad de Adultos:</label>
                    <input type="number" id="cantidad_personas" name="cantidad_personas" min="1" placeholder="Número de adultos" required>

                    <label for="cantidad_ninos">Cantidad de Niños:</label>
                    <input type="number" id="cantidad_ninos" name="cantidad_ninos" min="0" placeholder="Número de niños" required>

                    <button type="submit">Confirmar Reserva</button>
                </form>
            </div>
        </body>
        </html>
    <?php else: ?>
        <div class="container">
            <p>El tour seleccionado no existe. Por favor, selecciona un tour válido.</p>
        </div>
    <?php endif;
} else {
    echo '<div class="container"><p>No se especificó un tour para reservar.</p></div>';
}
?>
