<?php
session_start();
require_once 'templates/header.php';
require_once 'config/conexion.php';
//require_once '../auth/authenticate.php'; // Asumiendo que ya has manejado la autenticación

/* Verifica el rol del usuario y redirige a la página correspondiente
if (isset($_SESSION['user_rol'])) {
    if ($_SESSION['user_rol'] === 'admin') {
        header('Location: /admin/indexAdmin.php');
        exit();
    } elseif ($_SESSION['user_rol'] === 'cliente') {
        header('Location: /client/indexClient.php');
        exit();
    } else {
        // Redirigir a una página de error o inicio de sesión si el rol es desconocido
        header('Location: auth/login.php');
        exit();
    }
} else {
    // Redirigir a la página de inicio de sesión si no hay sesión activa
    header('Location: auth/login.php');
    exit();
}*/
?>
<!-- El resto del contenido de home.php, que no debería haber nada antes de los headers -->

<div class="container">
    <h1>Bienvenido a Nuestro Sitio de Películas</h1>
    <p>Explora nuestras películas disponibles.</p>

    <div class="row">
        <?php
        $consultaSQL = "SELECT id, titulo, descripcion, imagen FROM peliculas LIMIT 5";  // Solo muestra 5 películas para simplificar
        $consulta = $conexion->query($consultaSQL);
        
        while ($elemento = $consulta->fetch_object()) {
            echo "<div class='col-md-4'>";
            echo "<div class='card mb-4 box-shadow'>";
            echo "<img class='card-img-top' src='public/img/{$elemento->imagen}' alt='{$elemento->titulo}' style='width: 100%; height: 225px; object-fit: cover;'>";
            echo "<div class='card-body'>";
            echo "<h5>{$elemento->titulo}</h5>";
            echo "<p class='card-text'>" . substr($elemento->descripcion, 0, 100) . "...</p>";
            echo "<div class='d-flex justify-content-between align-items-center'>";
            echo "<div class='btn-group'>";
            
            if (isset($_SESSION['user_id'])) {
                // Si el usuario está autenticado, muestra el botón de comprar
                echo "<a href='./comprar.php?id={$elemento->id}' class='btn btn-primary'>Comprar</a>";
            } else {
                // Si no está autenticado, redirigir al login
                echo "<a href='auth/login.php' class='btn btn-primary'>Comprar</a>";
            }
            
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php
require_once 'templates/footer.php';
?>