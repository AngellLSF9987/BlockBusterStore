<?php
require_once "../config/conexion.php";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT id FROM usuarios WHERE verification_token = ? AND verified = 0";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId);
        $stmt->fetch();

        // Actualizar el estado de verificación del usuario
        $updateSql = "UPDATE usuarios SET verified = 1 WHERE id = ?";
        $updateStmt = $conexion->prepare($updateSql);
        $updateStmt->bind_param("i", $userId);
        $updateStmt->execute();

        echo "<p style='color:green;'>Cuenta verificada con éxito. Ahora puedes iniciar sesión.</p>";
    } else {
        echo "<p style='color:red;'>Token inválido o la cuenta ya está verificada.</p>";
    }

    $stmt->close();
    $conexion->close();
}
?>