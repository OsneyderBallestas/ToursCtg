<?php
session_start(); // Iniciar sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: inicio_sesion.php"); // Redirigir al login si no está logueado
    exit();
}

include 'db.php';

// Obtener todas las reservas de la base de datos
$query = "SELECT r.id, r.cliente_nombre, r.cliente_email, r.telefono, r.fecha_reserva, r.cantidad_personas, r.cantidad_ninos, r.estado, t.titulo 
          FROM reservas r 
          INNER JOIN tours t ON r.tour_id = t.id 
          ORDER BY r.created_at DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Reservas</title>
    <link rel="stylesheet" href="css/admin-reservas.css">
</head>
<body>
     <!-- Incluir el header -->
     <?php include 'header-admin.php'; ?>

     <div class="volver-admin">
        <a href="admin.php">Volver</a>
    </div>
    <div class="container">
        <h1>Administración de Reservas</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Tour</th>
                    <th>Fecha</th>
                    <th>Personas</th>
                    <th>Niños</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla-reservas">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr id="reserva-<?= $row['id']; ?>">
                        <td><?= $row['id']; ?></td>
                        <td><?= htmlspecialchars($row['cliente_nombre']); ?></td>
                        <td><?= htmlspecialchars($row['cliente_email']); ?></td>
                        <td><?= htmlspecialchars($row['telefono']); ?></td>
                        <td><?= htmlspecialchars($row['titulo']); ?></td>
                        <td><?= $row['fecha_reserva']; ?></td>
                        <td><?= $row['cantidad_personas']; ?></td>
                        <td><?= $row['cantidad_ninos']; ?></td>
                        <td>
                            <select onchange="actualizarEstado(<?= $row['id']; ?>, this.value)">
                                <option value="pendiente" <?= $row['estado'] === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="confirmada" <?= $row['estado'] === 'confirmada' ? 'selected' : ''; ?>>Confirmada</option>
                                <option value="cancelada" <?= $row['estado'] === 'cancelada' ? 'selected' : ''; ?>>Cancelada</option>
                            </select>
                        </td>
                        <td>
                            <button onclick="eliminarReserva(<?= $row['id']; ?>)">Eliminar</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script>
        function actualizarEstado(reservaId, nuevoEstado) {
            const formData = new FormData();
            formData.append('reserva_id', reservaId);
            formData.append('estado', nuevoEstado);

            fetch('actualizar-reserva.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Estado actualizado con éxito.');
                } else {
                    alert('Error al actualizar el estado.');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function eliminarReserva(reservaId) {
            if (!confirm('¿Estás seguro de eliminar esta reserva?')) {
                return;
            }

            fetch(`eliminar-reserva.php?id=${reservaId}`, { method: 'GET' })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`reserva-${reservaId}`).remove();
                    alert('Reserva eliminada con éxito.');
                } else {
                    alert('Error al eliminar la reserva.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
