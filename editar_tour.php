<?php
// Incluir archivo de conexión
include('db.php');

// Obtener el id del tour
$tour_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Obtener datos del tour con el nombre de la categoría
$sql = "SELECT t.*, c.nombre AS categoria_nombre
        FROM tours t
        LEFT JOIN categorias c ON t.categoria_id = c.id
        WHERE t.id = $tour_id";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    die("No se encontró el tour con ID especificado.");
}

$tour = $result->fetch_assoc();
$imagen_actual = $tour['imagen'];
$banner_actual = $tour['banner'];

// Obtener todas las categorías para mostrarlas en el <select>
$categ_sql = "SELECT id, nombre FROM categorias";
$categ_res = $conn->query($categ_sql);
$categorias = [];
while ($row = $categ_res->fetch_assoc()) {
    $categorias[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Directorios de destino
    $dir_imagen = "img/img-tours/";
    $dir_banner = "img/banner-tours/";

    // Guardar los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $descripcion_general = $_POST['descripcion_general'];
    $incluye = $_POST['incluye'];
    $no_incluye = $_POST['no_incluye'];
    $horario = $_POST['horario'];
    $duracion = $_POST['duracion'];
    $punto_encuentro = $_POST['punto_encuentro'];
    $recomendaciones = $_POST['recomendaciones'];
    
    // Limpiar los precios de puntos antes de guardarlos
    $precio_limpio = str_replace('.', '', $_POST['precio']);
    $precio_por_persona_limpio = str_replace('.', '', $_POST['precio_por_persona']);
    
    // Convertirlos a número
    $precio = floatval($precio_limpio);
    $precio_por_persona = floatval($precio_por_persona_limpio);

    $categoria_id = $_POST['categoria_id'];
    $estado = $_POST['estado'];

    // Por defecto, mantenemos las rutas actuales de imagenes
    $ruta_imagen = $imagen_actual; 
    $ruta_banner = $banner_actual; 

    
    // Procesar nueva imagen (si se sube)
if (!empty($_FILES['imagen']['name'])) {
    $nombre_imagen = basename($_FILES['imagen']['name']);
    $nueva_ruta_imagen = $dir_imagen . $nombre_imagen;
    
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $nueva_ruta_imagen)) {
        // Mover la imagen anterior a la carpeta Eliminados si existe y es distinta
        if ($imagen_actual !== $nueva_ruta_imagen && file_exists($imagen_actual)) {
            $ruta_eliminados = "img/eliminados/" . basename($imagen_actual);
            rename($imagen_actual, $ruta_eliminados);
        }
        $ruta_imagen = $nueva_ruta_imagen;
    } else {
        echo "Error al subir la imagen.";
    }
}

// Procesar nuevo banner (si se sube)
if (!empty($_FILES['banner']['name'])) {
    $nombre_banner = basename($_FILES['banner']['name']);
    $nueva_ruta_banner = $dir_banner . $nombre_banner;
    
    if (move_uploaded_file($_FILES['banner']['tmp_name'], $nueva_ruta_banner)) {
        // Mover el banner anterior a la carpeta Eliminados si existe y es distinto
        if ($banner_actual !== $nueva_ruta_banner && file_exists($banner_actual)) {
            $ruta_eliminados = "img/eliminados/" . basename($banner_actual);
            rename($banner_actual, $ruta_eliminados);
        }
        $ruta_banner = $nueva_ruta_banner;
    } else {
        echo "Error al subir el banner.";
    }
}



    // Actualizar la información en la BBDD
    $update_sql = "UPDATE tours SET
        titulo = '".$conn->real_escape_string($titulo)."',
        descripcion = '".$conn->real_escape_string($descripcion)."',
        descripcion_general = '".$conn->real_escape_string($descripcion_general)."',
        incluye = '".$conn->real_escape_string($incluye)."',
        no_incluye = '".$conn->real_escape_string($no_incluye)."',
        horario = '".$conn->real_escape_string($horario)."',
        duracion = '".$conn->real_escape_string($duracion)."',
        punto_encuentro = '".$conn->real_escape_string($punto_encuentro)."',
        recomendaciones = '".$conn->real_escape_string($recomendaciones)."',
        precio = '".$conn->real_escape_string($precio)."',
        precio_por_persona = '".$conn->real_escape_string($precio_por_persona)."',
        categoria_id = '".$conn->real_escape_string($categoria_id)."',
        estado = '".$conn->real_escape_string($estado)."',
        imagen = '".$conn->real_escape_string($ruta_imagen)."',
        banner = '".$conn->real_escape_string($ruta_banner)."'
        WHERE id = $tour_id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: editar_tour.php?id=$tour_id&actualizado=1");
        exit;
    } else {
        echo "Error actualizando: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tour</title>
    <link rel="stylesheet" href="css/editar_tour.css">
</head>
<body>
    <!-- Incluir el header -->
    <?php include 'header-admin.php'; ?>
    
    <div class="volver-admin">
        <a href="admin.php">Volver</a>
    </div>
    
    <div class="container">
        <h1>Editar Tour: <?php echo htmlspecialchars($tour['titulo']); ?></h1>
        <?php if (isset($_GET['actualizado'])): ?>
            <p class="msg-exito">¡Tour actualizado con éxito!</p>
        <?php endif; ?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Campos del tour -->
            <div class="form-group">
                <label for="titulo">Título del Tour</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($tour['titulo']); ?>" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"><?php echo htmlspecialchars($tour['descripcion']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="descripcion_general">Descripción General</label>
                <textarea id="descripcion_general" name="descripcion_general" rows="4"><?php echo htmlspecialchars($tour['descripcion_general']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="incluye">Incluye</label>
                <textarea id="incluye" name="incluye" rows="4"><?php echo htmlspecialchars($tour['incluye']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="no_incluye">No Incluye</label>
                <textarea id="no_incluye" name="no_incluye" rows="4"><?php echo htmlspecialchars($tour['no_incluye']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="horario">Horario</label>
                <input type="text" id="horario" name="horario" value="<?php echo htmlspecialchars($tour['horario']); ?>">
            </div>

            <div class="form-group">
                <label for="duracion">Duración</label>
                <input type="text" id="duracion" name="duracion" value="<?php echo htmlspecialchars($tour['duracion']); ?>">
            </div>

            <div class="form-group">
                <label for="punto_encuentro">Punto de Encuentro</label>
                <textarea id="punto_encuentro" name="punto_encuentro" rows="4"><?php echo htmlspecialchars($tour['punto_encuentro']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="recomendaciones">Recomendaciones</label>
                <textarea id="recomendaciones" name="recomendaciones" rows="4"><?php echo htmlspecialchars($tour['recomendaciones']); ?></textarea>
            </div>

            <!-- Campos de entrada para precio -->
            <div class="form-group">
                <label for="precio">Precio COP</label>
                <input 
                    type="text" 
                    id="precio" 
                    name="precio"
                    value="<?php echo htmlspecialchars(number_format((float)$tour['precio'], 0, ',', '.')); ?>" 
                    oninput="formatearMoneda(this)">
            </div>

            <div class="form-group">
                <label for="precio_por_persona">Precio COP por Persona</label>
                <input 
                    type="text" 
                    id="precio_por_persona" 
                    name="precio_por_persona"
                    value="<?php echo htmlspecialchars(number_format((float)$tour['precio_por_persona'], 0, ',', '.')); ?>" 
                    oninput="formatearMoneda(this)">
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select id="categoria_id" name="categoria_id">
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $tour['categoria_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select id="estado" name="estado">
                    <option value="1" <?php echo ($tour['estado'] == 1) ? 'selected' : ''; ?>>Activo</option>
                    <option value="0" <?php echo ($tour['estado'] == 0) ? 'selected' : ''; ?>>Inactivo</option>
                </select>
            </div>

            <!-- Sección para la imagen principal -->
            <div class="image-section">
                <h2>Imagen del Tour</h2>
                <div class="image-drop-area" id="drop-area-imagen">
                    <img id="preview-imagen" src="<?php echo htmlspecialchars($imagen_actual); ?>" alt="Imagen Actual">
                    <p class="image-name" id="image-name-imagen">
                        <?php echo htmlspecialchars(basename($imagen_actual)); ?>
                    </p>
                    <input type="file" name="imagen" id="input-imagen" accept="image/*">
                    <label for="input-imagen" class="btn-select">Seleccionar Imagen</label>
                    <p class="drag-text">Arrastra y suelta aquí la nueva imagen</p>
                </div>
            </div>

            <!-- Sección para el banner -->
            <div class="image-section">
                <h2>Banner del Tour</h2>
                <div class="image-drop-area" id="drop-area-banner">
                    <img id="preview-banner" src="<?php echo htmlspecialchars($banner_actual); ?>" alt="Banner Actual">
                    <p class="image-name" id="image-name-banner">
                        <?php echo htmlspecialchars(basename($banner_actual)); ?>
                    </p>
                    <input type="file" name="banner" id="input-banner" accept="image/*">
                    <label for="input-banner" class="btn-select">Seleccionar Banner</label>
                    <p class="drag-text">Arrastra y suelta aquí el nuevo banner</p>
                </div>
            </div>

            <input type="submit" value="Guardar Cambios" class="btn-guardar">
        </form>
    </div>
    <script src="js/editar_tour.js"></script>
</body>
</html>
