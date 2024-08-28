<!-- login.php -->
<?php
require_once  "../config/conexion.php";
require_once  "../templates/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['nomUsr'];
    $password = $_POST['password'];

    // Aquí deberías hacer la validación de usuario y contraseña en la base de datos
    $stmt = $conn->prepare('SELECT id, rol FROM usuarios WHERE nomUsr = :nomUsr AND password = :password');
    $stmt->bindParam(':nomUsr', $username);
    $stmt->bindParam(':password', $password); // Considera usar un hash de contraseña
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['rol'] = $usuario['rol'];

        // Redirige según el rol
        if ($user['rol'] === 'admin') {
            header('Location: /admin/indexAdmin.php');
        } else {
            header('Location: /client/indexClient.php');
        }
        exit;
    } else {
        $message = 'Credenciales incorrectas';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h2>Iniciar Sesión</h2>
    <form action="./authenticate.php" method="POST">
        <label for="nomUsr">Nombre de Usuario:</label>
        <input type="text" name="nomUsr" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Ingresar">
    </form>
    <a href="/auth/register.php">Únete!</a>
</body>

</html>

<?php
include "../templates/footer.php";
?>