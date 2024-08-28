<?php
session_start();
include "../config/conexion.php";
include "../templates/header.php";

$consulta = $conexion->query("SELECT * FROM peliculas");
while ($elemento = $consulta->fetch_object()) {
    $id = $elemento->id;
    $titulo = $elemento->titulo;
    $descripcion = $elemento->descripcion;
    $categoria = $elemento->categoria_id;
    $precio = $elemento->precio_id;
    $imagen = $elemento->imagen;
    echo "<div class='row'>";

    echo "<div style = 'width:300px; float:left; margin:10px; text-align:'center'>";
    echo "<h2 style = 'text-align:center'>" . $titulo . "</h2>";
    echo "<h3 style = 'color: blue; text-align:center'>" . $descripcion . "</h3>";
    echo "<h3 style = 'color: blue; text-align:center'>" . $categoria . "</h3>";
    echo "<p style = 'text-align:center'><img src ='../public/img/" . $imagen . "'width = 200px></p>";
    echo "</div>";
    echo "<p style = 'text-align:center'><a href ='indexClient.php?id=$id'><input type = 'submit' class='btn btn-info btn-sm' value = 'Inicio..'></a></p>";
    echo "</div>";
}
?>

<?php include "../templates/header.php"; ?>
