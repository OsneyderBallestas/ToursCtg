<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $reserva_id = intval($_GET['id']);

    $delete_query = $conn->prepare("DELETE FROM reservas WHERE id = ?");
    $delete_query->bind_param("i", $reserva_id);

    if ($delete_query->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No se pudo eliminar la reserva.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
}
?>
