<?php
include "../../config/conexion.php";

//Cuando mostramos la página con el formulario y los datos del alumno
if (!isset($_GET['id'])) { //Si no nos pasan el id del alumno        
  echo "La pelicula no existe";
} else {
  $id = $_GET['id'];
  $consultaSQL = "SELECT * FROM peliculas WHERE id =" . $id;
  $sentencia = $conexion->query($consultaSQL);
  $pelicula = $sentencia->fetch_object();
  if ($pelicula) {
    $titulo = $pelicula->titulo;
    $descripcion = $pelicula->descripcion;
    $categoria = $pelicula->categoria;
    $precio = $pelicula->precio;
    $imagen = $pelicula->imagen;
  } else {
    echo 'No se ha encontrado el pelicula';
  }
}

//Cuando nos envían los datos del alumno desde el formulario y tenemos que actualizarlo
if (isset($_POST['submit'])) {
  $id = $_GET['id'];
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $categoria = $_POST['categoria'];
  $precio = $_POST['precio'];

  //Aquí el tratamiento de la imagen es un poco más complicado. 
  //Si no pasan titulo de fichero, mantenemos la que había. Si pasan titulo, subimos el nuevo fichero        
  if (isset($_FILES['imagen']['name']) && $_FILES['imagen']['name'] != "") {  //Si nos pasan un nuevo fichero
    $imagen = date("Y-m-d - H-i-s") . "-" . $_FILES['imagen']['name'];
    $file_loc = $_FILES['imagen']['tmp_name'];
    move_uploaded_file($file_loc, "../../public/uploads/" . $imagen);
    $consultaSQL = "UPDATE peliculas SET  titulo = '$titulo', descripcion = '$descripcion', categoria = '$categoria',  precio = $precio, ";
    $consultaSQL .= "imagen = '$imagen', updated_at = NOW() WHERE id = $id";
  } else {
    //NO nos han pasado fichero, no tenemos que modificarlo, en la consulta no añadimos imagen
    $consultaSQL = "UPDATE peliculas SET  titulo = '$titulo', descripcion = '$descripcion', categoria = '$categoria',  precio = $precio, ";
    $consultaSQL .= "updated_at = NOW() WHERE id = $id";
  }
  $consulta = $conexion->query($consultaSQL);
  header("Status: 301 Moved Permanently");
  header("Location: ../indexAdmin.php");
  exit;
}
?>

<?php require "../../templates/header.php"; ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Editando la Pelicula <?= escapar($titulo) . ' ' . escapar($categoria_id)  ?></h2>
      <hr>
      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="titulo">Titulo</label>
          <input type="text" name="titulo" id="titulo" value="<?= escapar($titulo) ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripcion</label>
          <input type="text" name="descripcion" id="descripcion" value="<?= escapar($descripcion) ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="categoria" class="form-label" style='font-weight:bold;' name="categoria">Categorias</label>
          <select name="categoria" class="form-select" style='font-weight:bold;'>
            <option selected>Selecciona Categoria</option>
            <?php
            $sql = "SELECT * FROM categorias";
            $categoria = $conexion->query($sql);
            while ($cat = $categoria->fetch_object()) {
              $nomCat = $cat->nomCat;
              $idcat = $cat->id;
              $aux = ($categoria == $cat->id) ? "selected" : "";
              echo "<option value='$idcat' $aux>$nomCat</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="precio" class="form-label" style='font-weight:bold;' name="precio">Precios</label>
          <select name="precio" class="form-select" style='font-weight:bold;'>
            <option selected>Selecciona Precios</option>
            <?php
            $sql = "SELECT * FROM precios";
            $precio = $conexion->query($sql);
            while ($prec = $precio->fetch_object()) {
              $nomPrec = $prec->nomPrec;
              $idprec = $prec->id;
              $aux = ($precio == $prec->id) ? "selected" : "";
              echo "<option value='$idprec' $aux>$nomPrec</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="imagen">Imagen</label>
          <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
        </div>
        <?php
        //Si tiene imagen la mostramos
        if ($imagen != "") {
          echo "<br><img src='../../public/uploads/$imagen' style='width: 100px'><br>";
        }
        ?>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-success" value="✏️Actualizar">
          <a class="btn btn-primary" href="../indexAdmin.php">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>
<hr>
<tr></tr>
<?php require "../../templates/footer.php"; ?>