<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: inicio_sesion.php");
    exit();
}

include 'db.php'; // Conexión a la base de datos

// Manejar la acción de agregar un nuevo tour
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_tour'])) {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $precio = str_replace(',', '', $_POST['precio']); // Eliminar formato de moneda (comas)
    $precio = str_replace('.', '', $precio); // Eliminar puntos del precio
    $precio = floatval($precio); // Convertir el precio a un número flotante
    $categoria_id = intval($_POST['categoria_id']); // Asegurar que la categoría es un número

    // Manejar la subida de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = basename($_FILES['imagen']['name']); // Obtener el nombre del archivo
        $rutaTemporal = $_FILES['imagen']['tmp_name']; // Ruta temporal del archivo
        $extension = pathinfo($nombreImagen, PATHINFO_EXTENSION); // Obtener la extensión
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif']; // Extensiones válidas

        // Validar la extensión de la imagen
        if (!in_array(strtolower($extension), $extensionesPermitidas)) {
            echo "Formato de imagen no permitido. Solo se aceptan JPG, PNG o GIF.";
            exit();
        }

        // Crear una ruta única para evitar conflictos de nombres
        $rutaDestino = 'img-tours/' . uniqid() . '-' . $nombreImagen;

        // Crear la carpeta si no existe
        if (!is_dir('img-tours')) {
            mkdir('img-tours', 0777, true);
        }

        // Mover el archivo a la carpeta img-tours
        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            // Guardar los datos en la base de datos
            $stmt = $conn->prepare("INSERT INTO tours (titulo, imagen, descripcion, precio, categoria_id, estado) VALUES (?, ?, ?, ?, ?, 1)");
            if ($stmt === false) {
                echo "Error al preparar la consulta: " . $conn->error;
                exit();
            }
            $stmt->bind_param("sssdi", $titulo, $rutaDestino, $descripcion, $precio, $categoria_id);

            if ($stmt->execute()) {
                header('Location: admin.php'); // Redirigir después de guardar
                exit();
            } else {
                echo "Error al guardar el tour: " . $stmt->error;
                exit();
            }
        } else {
            echo "Error al mover la imagen al directorio img-tours.";
            exit();
        }
    } else {
        echo "Error al subir la imagen.";
        exit();
    }
}

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
    <title>Agregar Nuevo Tour</title>
    <link rel="stylesheet" href="css/agregar-tour.css">
</head>
<body>

<!-- Incluir el header -->
<?php include 'header-admin.php'; ?>

<div class="volver-admin">
    <a href="admin.php">Volver</a>
</div>

<form method="POST" action="agregar_tour.php" class="form-container" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" placeholder="Título del tour" required>
    </div>
    <div class="form-group">
        <label for="imagen">Subir Imagen</label>
        <div id="drop-zone">
            <p>Arrastra y suelta la imagen aquí, o haz clic para seleccionar un archivo</p>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>
        </div>
        <div id="preview-container">
            <img id="image-preview" style="display: none; max-width: 100%; height: auto;">
            <p id="file-name" style="display: none;"></p>
        </div>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" placeholder="Descripción del tour" required></textarea>
    </div>
    <div class="form-group">
        <label for="precio">Precio (COP)</label>
        <input type="text" id="precio" name="precio" placeholder="Precio en pesos colombianos" required>
    </div>
    <div class="form-group">
        <label for="categoria_id">Categoría</label>
        <select id="categoria_id" name="categoria_id">
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" name="add_tour" class="btn-submit">Agregar Tour</button>
</form>

<script src="js/agregar-tours.js"></script>
</body>
</html>
