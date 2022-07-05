<?php


include("conexion.php");
include("funciones.php");


if(isset($_POST["id_usuario"])) {
    $imagen='';

    $stmt = $conexion->prepare("DELETE FROM mascotas_adopcion  WHERE id = :id");

     $resultado = $stmt->execute(
         array(    
             ':id'=> $_POST["id_usuario"]
             )
         );

         if(!empty($resultado)) { 
                echo 'Registro borrado';
         }
}