<?php
session_start(); // Iniciar sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: inicio_sesion.php"); // Redirigir al login si no está logueado
    exit();
}

include 'db.php'; // Conexión a la base de datos

// Manejar solicitudes AJAX para Ocultar/Mostrar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'toggle_tour') {
        $id = intval($_POST['id']);
        $estado = $_POST['estado'] == 1 ? 0 : 1;

        $stmt = $conn->prepare("UPDATE tours SET estado = ? WHERE id = ?");
        $stmt->bind_param("ii", $estado, $id);
        $stmt->execute();

        echo json_encode(['success' => true, 'estado' => $estado]);
        exit;
    }

    // Manejar solicitudes AJAX para eliminar un tour
    if ($_POST['action'] === 'delete_tour') {
        $id = intval($_POST['id']);

        $stmt = $conn->prepare("DELETE FROM tours WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al eliminar el tour.']);
        }

        $stmt->close();
        exit;
    }
}

// Obtener tours
$query = "SELECT t.*, c.nombre AS categoria FROM tours t JOIN categorias c ON t.categoria_id = c.id";
$result = $conn->query($query);
$tours = $result->fetch_all(MYSQLI_ASSOC);

// Obtener categorías
$queryCategorias = "SELECT * FROM categorias";
$resultCategorias = $conn->query($queryCategorias);
$categorias = $resultCategorias->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Tours</title>
    <link rel="stylesheet" href="css/admin.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Incluir el header -->
    <?php include 'header-admin.php'; ?>

    <h2>Panel de Administración de Tours</h2>

    <div class="filters-wrapper">
        <div class="filters-container">
            <!-- Filtro de Categoría -->
            <div class="filter-item">
                <label for="filter-category">Categoría</label>
                <select id="filter-category" class="form-select">
                    <option value="all">Todos</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= htmlspecialchars($categoria['nombre']) ?>"><?= htmlspecialchars($categoria['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Barra de búsqueda -->
            <div class="search-container">
                <label for="search-bar">Buscar</label>
                <div class="search-bar">
                    <input type="text" id="search-bar" class="form-control" placeholder="Buscar por nombre, precio, estado, etc.">
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de tours existentes -->
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tour-list">
            <?php foreach ($tours as $tour): ?>
                <tr data-category="<?= htmlspecialchars($tour['categoria']) ?>" 
                    data-name="<?= htmlspecialchars($tour['titulo']) ?>" 
                    data-price="<?= $tour['precio'] ?>" 
                    data-state="<?= $tour['estado'] ? 'Visible' : 'Oculto' ?>">
                    <td><?= htmlspecialchars($tour['titulo']) ?></td>
                    <td><img src="<?= htmlspecialchars($tour['imagen']) ?>" alt="<?= htmlspecialchars($tour['titulo']) ?>" width="100"></td>
                    <td><?= htmlspecialchars($tour['descripcion']) ?></td>
                    <td>$<?= number_format($tour['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($tour['categoria']) ?></td>
                    <td class="estado"><?= $tour['estado'] ? 'Visible' : 'Oculto' ?></td>
                    <td>
                        <!-- Botón Eliminar -->
                        <button type="button" class="btn-delete" data-id="<?= $tour['id'] ?>">Eliminar</button>

                        <!-- Botón Ocultar/Mostrar -->
                        <button type="button" 
                                class="btn-toggle" 
                                data-id="<?= $tour['id'] ?>" 
                                data-estado="<?= $tour['estado'] ?>">
                            <?= $tour['estado'] ? 'Ocultar' : 'Mostrar' ?>
                        </button>

                        <!-- Botón Editar -->
                        <a href="admin.php?edit_id=<?= $tour['id'] ?>" class="btn-edit">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="js/admin-btn.js"></script>
    <script src="js/filtro-admin.js"></script>
</body>
</html>
