<?php

include("conexion.php");
include("funciones.php");

if(isset($_POST["id_usuario"])) {

    $salida = array();
    $stmt = $conexion->prepare("SELECT * FROM mascotas_adopcion WHERE id ='".$_POST["id_usuario"]."' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach($resultado as $fila){
           $salida["nombre"] = $fila["nombre"];
           $salida["mascota"] = $fila["mascota"];
           $salida["adoptado"] = $fila["adoptado"];
           $salida["dueno"] = $fila["dueno"];
            
    }

    echo json_encode($salida);

}