<?php
session_start();
include('db.php'); // Archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE (nombre_usuario = ? OR correo = ?) AND contraseña = ?";
    $stmt = $conn->prepare($sql);
    $hashed_password = md5($contrasena); // Encriptar la contraseña para comparación
    $stmt->bind_param("sss", $usuario, $usuario, $hashed_password);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        // Usuario encontrado
        $usuario_data = $resultado->fetch_assoc();
        $_SESSION['id_usuario'] = $usuario_data['id'];
        $_SESSION['nombre_usuario'] = $usuario_data['nombre_usuario'];

        // Redirigir al archivo deseado
        header("Location: admin.php");
        exit();
    } else {
        // Credenciales incorrectas
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='inicio_sesion.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
