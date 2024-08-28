<?php 
  include "../../config/conexion.php";
  include "../../templates/header.php";
?>
<?php

  if (isset($_POST['submit'])) {
    $nombreFichero = date("Y-m-d - H-i-s")."-".$_FILES['imagen']['name'];
    //Leo la ubicación temporal del archivo para después dejarlo en la carpeta deseada
    $file_loc = $_FILES['imagen']['tmp_name'];        
    //movemos el archivo a la carpeta deseada
    move_uploaded_file($file_loc,"../../public/uploads/".$nombreFichero); 

    $titulo=escapar($_POST["titulo"]);
    $descripcion=escapar($_POST["descripcion"]);
    $categoria=$_POST["categoria"];
    $precio=$_POST["precio"];
    $imagen=$nombreFichero;
    $consulta=$conexion->query("INSERT INTO peliculas (titulo, descripcion, categoria, precio, imagen) VALUES
      ('$titulo', '$descripcion', '$categoria', $precio, '$imagen')");
    echo "<p class='alert alert-success'>Registro de la Pelicula $titulo, $categoria  añadido</p>";

  }
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Alta Nuevo Registro</h2>
      <hr>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="titulo">Titulo</label>
          <input type="text" name="titulo" id="titulo" class="form-control">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripcion</label>
          <input type="text" name="descripcion" id="descripcion" class="form-control">
        </div>
        <div class="form-group">
          <label for="categoria" class="form-label" style='font-weight:bold;' name="categoria">Categorias</label>
          <select name="categoria" class="form-select" style='font-weight:bold;'>
            <option selected>Selecciona Categoria</option>
            <?php
            $sql = "SELECT * FROM categorias";
            $categorias = $conexion->query($sql);
            while ($cat = $categorias->fetch_object()) {
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
            $precios = $conexion->query($sql);
            while ($prec = $precios->fetch_object()) {
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
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-success" value="✏️Enviar">
          <a class="btn btn-primary" href="../indexAdmin.php">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
  
</div>
<hr>
<tr></tr>
<?php include "../../templates/footer.php"; ?>