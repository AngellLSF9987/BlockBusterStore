<?php
include "../config/conexion.php";
include "../templates/header.php"; 
/*
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php", $true, 301);
}
*/
csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
    die();
}


/*
if (isset($_SESSION["usuario"])) {
    $id = $_SESSION["usuario"];
    $resultado = $conexion->query("SELECT * FROM usuarios WHERE id=$id");
    $elemento = $resultado->fetch_object();
    $nomUsr = $elemento->nomUsr;
    echo "<h2 class='text-center' style='aling-content:center'>Hola $nomUsr</h2>";
}*/
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="crud/crear.php" class="btn btn-success mt-4">✏️Crear Nuevo Registro</a>
            <hr>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <form action="" method="post" class="form-inline">
                <div class="form-group mr-3">
                    <input type="text" id="titulo" name="titulo" placeholder="Buscar por titulo" class="form-control">
                </div>
                <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
                <button type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['titulo'])) {
        $titulo = $_POST['titulo'];
        $consultaSQL = "SELECT * FROM peliculas WHERE titulo LIKE '%$titulo%'";
        $titulo = ($titulo != "") ? 'Lista de Peliculas (' . $_POST['titulo'] . ')' : 'Lista de Peliculas';
    } else {
        $consultaSQL = "SELECT * FROM peliculas";
        $titulo = 'Lista de Peliculas';
    }

    echo "<h1 class='mt-3'>$titulo</h1>";
    ?>
    <table class="table" style="font-weight:bold; text-align:center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $consulta = $conexion->query($consultaSQL);
            while ($elemento = $consulta->fetch_object()) {
                $id = $elemento->id;
                $titulo = $elemento->titulo;
                $descripcion = $elemento->descripcion;
                $categoria = $elemento->categoria;
                $precio = $elemento->precio;
                $imagen = $elemento->imagen;
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$titulo</td>";
                echo "<td><a href='detailAdmin.php?id=$id' class='btn btn-info btn-sm'>$descripcion</a></td>";
                echo "<td>$categoria</td>";
                echo "<td>$precio</td>";                    
                echo "<td><a href = '../public/img/$imagen'><img class='card-img-top' src='../public/img/" . $imagen . "' alt='Title' style='width:100px'></a></td>";                   
                echo "<td><a href='crud/editar.php?id=$id' class='btn btn-warning btn-sm'>✏️Editar</a></td>";
                echo "<td><form action='crud/borrar.php?id=$id' method='post' onSubmit='return confirm(\"Seguro?\")'><input type='submit' value='🗑️Borrar' class='btn btn-danger btn-sm'></form></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<hr>
<tr></tr>

<?php
include "../templates/footer.php";
?>