<?php

// Establecer conexión a la base de datos
$conexion = new mysqli("localhost", "root", "");

// Comprobar si hay errores en la conexión
if ($conexion->connect_error) {
    die("Fallo en la conexión: " . $conexion->connect_error);
}

// Eliminar la base de datos si existe
$consulta = "DROP DATABASE IF EXISTS store;";
if ($conexion->query($consulta) === FALSE) {
    echo "Error al eliminar la base de datos: " . $conexion->error;
}

// Crear la base de datos
$consulta = "CREATE DATABASE IF NOT EXISTS store;";
if ($conexion->query($consulta) === FALSE) {
    echo "Error al crear la base de datos: " . $conexion->error;
}

//Seleccionamos la base de datos y creamos la tabla si no existe
$conexion->select_db("store");
$consulta = "CREATE TABLE IF NOT EXISTS categorias (
    id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nomCat VARCHAR(30) NOT NULL
    );";
$conexion->query($consulta);


//Seleccionamos la base de datos y creamos la tabla si no existe
$conexion->select_db("store");
$consulta = "CREATE TABLE IF NOT EXISTS precios (
    id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nomPrec DECIMAL(10,2) NOT NULL
    );";
$conexion->query($consulta);


$conexion->select_db("store");
$consulta = "CREATE TABLE IF NOT EXISTS peliculas (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        descripcion TEXT NOT NULL,
        categoria INT(2) UNSIGNED,     
        precio INT (2) UNSIGNED,
        imagen VARCHAR(255) NOT NULL,
		    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);";

$conexion->query($consulta);


$conexion->select_db("store");
$consulta = "ALTER TABLE peliculas ADD CONSTRAINT FK_categoria FOREIGN KEY (categoria) REFERENCES categorias(id);";
$conexion->query($consulta);

$conexion->select_db("store");
$consulta = "ALTER TABLE peliculas ADD CONSTRAINT FK_precio FOREIGN KEY (precio) REFERENCES precios(id);";
$conexion->query($consulta);

$conexion->select_db("store");
$consulta = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nomUsr VARCHAR(255) NOT NULL UNIQUE,
        email VARCHAR(255) NOT NULL UNIQUE,
        rol VARCHAR(25) NOT NULL,
        password VARCHAR(255) NOT NULL
      );";
$conexion->query($consulta);


//Si la tabla "categorias" está vacía, añadimos datos de ejemplo

$consulta = "SELECT nomPrec FROM precios";
$resultado = $conexion->query($consulta);
if ($resultado->num_rows < 1) {

  $consulta = "INSERT INTO precios (nomPrec) 
          VALUES ('7,99');";
  $conexion->query($consulta);
  
    $consulta = "INSERT INTO precios (nomPrec) 
          VALUES ('10,99');";
  $conexion->query($consulta);
  
    $consulta = "INSERT INTO precios (nomPrec) 
          VALUES ('15,99');";
  $conexion->query($consulta);
  
    $consulta = "INSERT INTO precios (nomPrec) 
          VALUES ('20,99');";
  $conexion->query($consulta);
  
    $consulta = "INSERT INTO precios (nomPrec) 
          VALUES ('25,99');";
  $conexion->query($consulta);
  
  $consulta = "INSERT INTO precios (nomPrec) 
          VALUES ('29,99');";
  $conexion->query($consulta);

}
;

//Si la tabla "categorias" está vacía, añadimos datos de ejemplo

$consulta = "SELECT nomCat FROM categorias";
$resultado = $conexion->query($consulta);
if ($resultado->num_rows < 1) {

  $consulta = "INSERT INTO categorias (nomCat) 
          VALUES ('Ciencia Ficción');";
  $conexion->query($consulta);
  
    $consulta = "INSERT INTO categorias (nomCat) 
          VALUES ('Acción');";
  $conexion->query($consulta);
  
    $consulta = "INSERT INTO categorias (nomCat) 
          VALUES ('Comedia');";
  $conexion->query($consulta);
  
    $consulta = "INSERT INTO categorias (nomCat) 
          VALUES ('Thiller Suspense');";
  $conexion->query($consulta);
  
    $consulta = "INSERT INTO categorias (nomCat) 
          VALUES ('Familiares');";
  $conexion->query($consulta);
  
  $consulta = "INSERT INTO categorias (nomCat) 
          VALUES ('Infantiles');";
  $conexion->query($consulta);

}
;

//Si la tabla está vacía, añadimos datos de ejemplo
$consulta = "SELECT titulo FROM peliculas";
$resultado = $conexion->query($consulta);
if ($resultado->num_rows < 1) {

  $consulta = "INSERT INTO peliculas (titulo, descripcion, categoria, precio, imagen, created_at, updated_at)
  VALUES ('Los Vengadores', 'Pelicula del Universo Marvel', '1', '6', 'vengadores1.jpg', '2022-11-12 19:05:55','2022-11-12 19:05:55');";

  $conexion->query($consulta);
}

//Si la tabla "usuarios" está vacía, añadimos datos de ejemplo
$consulta = "SELECT nomUsr FROM usuarios";
$resultado = $conexion->query($consulta);
if ($resultado->num_rows < 1) {

  $consulta = "INSERT INTO usuarios (nomUsr, email, rol, password) 
        VALUES ('angel', 'angel@alumnos.com', 'admin', '1234');";

  $conexion->query($consulta);
}
;

function escapar($html)
{
  return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

function csrf()
{
  session_start();

  if (empty($_SESSION['csrf'])) {
    if (function_exists('random_bytes')) {
      $_SESSION['csrf'] = bin2hex(random_bytes(32));
    } else if (function_exists('mcrypt_create_iv')) {
      $_SESSION['csrf'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    } else {
      $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
  }
}
?>