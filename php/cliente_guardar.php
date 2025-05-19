<?php

    require_once "main.php";

    # storing data

    $nombre=limpiar_cadena($_POST['cliente_nombre']);
    $apellido=limpiar_cadena($_POST['cliente_apellido']);

    $dni=limpiar_cadena($_POST['cliente_dni']);
    $email=limpiar_cadena($_POST['cliente_email']);

    $telefono=limpiar_cadena($_POST['cliente_telefono']);
    $direccion=limpiar_cadena($_POST['cliente_direccion']);


    # required places verify

    if($nombre == "" || $apellido== "" || $dni== "" || $email== "" || $telefono=="" || $direccion=""){
        echo '
            <div class="notification is-danger is-light">
                <strong>Hubo un error inesperado </strong><br>
                No llenaste todos los campos
            </div>
            ';
        exit();
    }


    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $check_email=conexion();
        $check_email=$check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
        if($check_email->rowCount()>0){
            echo '
                <div class="notification is-danger is-light">
                    <strong>There was an unexpected error</strong><br>
                    The EMAIL entered is already registered
                </div> 
            ';
            exit();
        }
        $check_email=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The EMAIL entered is not valid 
            </div>      
        ';
        exit();
    }
    


    # Verifying user
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
    if($check_usuario->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The USER entered is already registered
            </div> 
        ';
        exit();
    }
    $check_usuario=null;


    # Verifying keys


    if($clave_1!=$clave_2){
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The KEYS entered doesnt match
            </div> 
        ';
        exit(); 
    }else{
        $clave=password_hash($clave_1, PASSWORD_BCRYPT, ["cost"=>10]);
    }

    # Saving the data
    
    

    // 1. Conexión a la base de datos
    $conexion = conexion();

    // 2. Preparar la consulta SQL con marcadores
    $sql = "INSERT INTO usuario(usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email) 
            VALUES(:nombre, :apellido, :usuario, :clave, :email)";
    $stmt = $conexion->prepare($sql);

    // 3. Definir los valores de los marcadores
    $marcadores = [
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":usuario" => $usuario,
        ":clave" => $clave,
        ":email" => $email
    ];

    // 4. Ejecutar la consulta con manejo de excepciones
    try {
        $stmt->execute($marcadores);
        echo '
            <div class="notification is-info is-light">
                <strong>USER REGISTERED</strong><br>
                The user was registered successfully.
            </div> 
        ';
    } catch (PDOException $e) {
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The USER could not be registered. Try again.
            </div> 
        ';
    }

    // 5. Cerrar la conexión
    $conexion = null;












