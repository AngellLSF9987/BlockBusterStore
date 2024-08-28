<!-- authenticate.php -->
<?php

require_once '../config/conexion.php'; // Asegúrate de que este archivo tenga la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomUsr = $_POST['nomUsr'];
    $password = $_POST['password'];

    // Conexión a la base de datos
    $conn = openConnection(); // Asume que tienes esta función en tu archivo db_connection.php

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("SELECT id, nomUsr, password, rol FROM usuarios WHERE nomUsr = ?");
    $stmt->bind_param("s", $nomUsr);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $usuario['password'])) {
            // Guardar datos en la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nomUsr'] = $usuario['nomUsr'];
            $_SESSION['rol'] = $usuario['rol'];

            // Redirigir según el rol
            if ($usuario['rol'] == 'admin') {
                header("Location: ../admin/indexAdmin.php");
            } else {
                header("Location: ../client/indexClient.php");
            }
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>