<!-- comprar.php -->
<?php
require_once "config/conexion.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Aquí puedes añadir la lógica para el proceso de compra. Por ejemplo:
    echo "<h1>Compra completada</h1>";
    echo "<p>Has comprado el artículo con ID: $id</p>";
    // Añadir más lógica según sea necesario, como agregar la compra a una base de datos o enviar un correo electrónico.
} else {
    echo "<h1>Error en la compra</h1>";
    echo "<p>No se especificó ningún artículo para comprar.</p>";
}

?>
<a href="./home.php">Volver al Inicio</a>