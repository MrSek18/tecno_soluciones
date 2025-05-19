<?php

    require_once 'main.php';

    $id=limpiar_cadena($_POST['categoria_id']);
    
    // Verificar el categoria
    $check_categoria=conexion();
    $check_categoria=$check_categoria->query("SELECT * FROM categoria WHERE categoria_id=$id");

    if($check_categoria->rowCount()<=0){
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The category does not exist in the system;
            </div> 
        ';
        exit();
    }else{
        $datos=$check_categoria->fetch();
    }
    $check_categoria=null;  

    
    # Almancenando datos 
    $nombre=limpiar_cadena($_POST['categoria_nombre']);
    $ubicacion=limpiar_cadena($_POST['categoria_ubicacion']);
        
    if($nombre == ""){
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                You didnt fill in all required fields
            </div>
            ';
        exit();
    }


   # Verification of data integrity

    if(!verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}", $nombre)){

        echo '
             <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The NAME doesnt match with the required format.
            </div>  
        ';
        exit();

    }    

    if($ubicacion!=""){
        
        if(!verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}", $ubicacion)){

            echo '
                <div class="notification is-danger is-light">
                    <strong>There was an unexpected error</strong><br>
                    the location doesnt match with the required format 
                </div>  
            ';
            exit();

        }  
    }

    # Verifying nombre
    if($nombre==$datos['categoria_nombre']){
        $check_nombre=conexion();
        $check_nombre=$check_nombre->query("SELECT categoria_nombre FROM categoria WHERE categoria_nombre='$nombre'");
        if($check_nombre->rowCount()>0){
            echo '
                <div class="notification is-danger is-light">
                    <strong>There was an unexpected error</strong><br>
                    the NAME entered already exists in the system, please enter another
                </div> 
            ';
            exit();
        }
        $check_nombre=null;    
    }

    // Actualizar datos
    $actualizar_categoria=conexion();
    $actualizar_categoria=$actualizar_categoria->prepare("UPDATE categoria SET categoria_nombre=:nombre, categoria_ubicacion=:ubicacion WHERE categoria_id=:id");


    $marcadores = [
        ":nombre" => $nombre,
        ":ubicacion" => $ubicacion,
        ":id" => $id
    ];


    if($actualizar_categoria->execute($marcadores)){
        echo '
             <div class="notification is-info is-light">
                <strong>¡USURARIO ACTUALIZADO!</strong><br>
                The CATEGORY has been updated successfully!
            </div>  
        ';
    }
    else{
        echo '
             <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The CATEGORY cannot be updated, please try again.
            </div>  
        ';
    }
    $actualizar_usuario=null;    