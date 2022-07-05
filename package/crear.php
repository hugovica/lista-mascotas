<?php

include("conexion.php");
include("funciones.php");

if($_POST["operacion"] == "Crear") {
    $imagen='';

    $stmt = $conexion->prepare("INSERT INTO mascotas_adopcion(nombre, mascota,
     adoptado, dueno)VALUES(:nombre, :mascota, :adoptado, :dueno)");

     $resultado = $stmt->execute(
         array(
            ':nombre'=> $_POST["nombre"],
             ':mascota'=> $_POST["mascota"],
             ':adoptado'=> $_POST["adoptado"],
             ':dueno'=> $_POST["dueno"]
             )  
         );

         if(!empty($resultado)) { 
                echo 'Registro creado';
         }
}


if($_POST["operacion"] == "Editar") {
    $imagen='';

    $stmt = $conexion->prepare("UPDATE mascotas_adopcion SET nombre=:nombre, mascota=:mascota, adoptado=:adoptado, dueno=:dueno WHERE id = :id");

     $resultado = $stmt->execute(
         array(
             ':nombre'=> $_POST["nombre"],
             ':mascota'=> $_POST["mascota"],
             ':adoptado'=> $_POST["adoptado"],
             ':dueno'=> $_POST["dueno"],
             ':id'=> $_POST["id_usuario"]
             )
         );

         if(!empty($resultado)) { 
                echo 'Registro actualizado';
         }
}