<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reserva_id = intval($_POST['reserva_id']);
    $nuevo_estado = $_POST['estado'];

    if (in_array($nuevo_estado, ['pendiente', 'confirmada', 'cancelada'])) {
        $update_query = $conn->prepare("UPDATE reservas SET estado = ? WHERE id = ?");
        $update_query->bind_param("si", $nuevo_estado, $reserva_id);

        if ($update_query->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se pudo actualizar el estado.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Estado inválido.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
}
?>
