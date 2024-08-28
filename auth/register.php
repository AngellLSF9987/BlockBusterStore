<?php
require_once "../config/conexion.php";
require_once "../templates/header.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Incluye PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomUsr = $_POST['nomUsr'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rol = 'client'; // Asignamos el rol de cliente por defecto

    // Generar un token de verificación único
    $verificationToken = bin2hex(random_bytes(16));

    // Preparar la consulta SQL para insertar el usuario
    $sql = "INSERT INTO usuarios (nomUsr, email, password, rol, verification_token, verified) VALUES (?, ?, ?, ?, ?, 0)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssss", $nomUsr, $email, $password, $rol, $verificationToken);

    if ($stmt->execute()) {
        // Enviar email de verificación
        $mail = new PHPMailer(true);
        try {
            $mail->setFrom('noreply@tu-sitio.com', 'BlockBuster Store');
            $mail->addAddress($email);
            $mail->Subject = 'Verificación de Email - BlockBuster Store';
            $mail->Body = "Hola $nomUsr,\n\nGracias por registrarte en BlockBuster Store. Para activar tu cuenta, haz clic en el siguiente enlace de verificación:\n\nhttp://localhost:84/ProyectosSubidos/BlockBusterStore/auth/verify.php?token=$verificationToken\n\nSi no has creado esta cuenta, ignora este correo.";
            $mail->send();
            echo "<p style='color:green;'>Registro exitoso. Por favor, verifica tu email para activar tu cuenta.</p>";
        } catch (Exception $e) {
            echo "<p style='color:red;'>No se pudo enviar el correo de verificación. Por favor, intenta de nuevo.</p>";
        }
    } else {
        echo "<p style='color:red;'>Error en el registro. Por favor, inténtalo de nuevo.</p>";
    }

    $stmt->close();
    $conexion->close();
}
?>

<div class="container">
    <h2>Registro de Usuario</h2>
    <form action="register.php" method="POST">
        <div class="form-group">
            <label for="nomUsr">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nomUsr" name="nomUsr" required>
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
</div>

<?php
require_once "../templates/footer.php";
?>