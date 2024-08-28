<?php
    include "../../config/conexion.php";      

    if (isset($_GET['id'])) {            
        $id=$_GET['id'];        
        $consultaSQL = "DELETE FROM peliculas WHERE id = $id";        
        $consulta = $conexion->query($consultaSQL);                        
    }
    header("Status: 301 Moved Permanently");
    header("Location: ../indexAdmin.php");
    exit;
?>