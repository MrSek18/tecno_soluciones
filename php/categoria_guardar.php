<?php
    require_once "main.php";

    # Almacenando datos 

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
    $check_usuario=null;

    # save the data

    $conexion = conexion();

    $sql = "INSERT INTO categoria(categoria_nombre, categoria_ubicacion) 
            VALUES(:nombre,:ubicacion)";
    $stmt = $conexion->prepare($sql);

    $marcadores = [
        ":nombre" => $nombre,
        ":ubicacion" => $ubicacion
    ];

    $stmt->execute($marcadores);

    if($stmt->rowCount()==1){
            
            echo '
                <div class="notification is-info is-light">
                    <strong>Category registered successfully</strong><br>
                    The category has been registered successfully
                </div>  
            ';
            exit();
    } else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>There was an unexpected error</strong><br>
                    The category could not be registered, please try again
                </div>  
            ';
            exit();
    }
    $stmt = null;   
















