<?php
    require_once '../inc/session_start.php';
    require_once 'main.php';

    $id=limpiar_cadena($_POST['usuario_id']);

    // Verificar el usuario

    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_id=$id");
    if($check_usuario->rowCount()<=0){
        echo '
        <div class="notification is-danger is-light">
            <strong>There was an unexpected error</strong><br>
            The USER does not exist in the system;
        </div> 
    ';
    exit();
    }else{
        $datos=$check_usuario->fetch();
    }
    $check_usuario=null;  

    $admin_usuario=limpiar_cadena($_POST['administrador_usuario']);
    $admin_clave=limpiar_cadena($_POST['administrador_clave']);


    # required places verify

    if($admin_usuario == "" || $admin_clave== ""){
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                You didnt fill in all required fields corresponding to your username and password
            </div>
            ';
        exit();
    }

    # Verification of data integrity

    if(!verificar_datos("[a-zA-Z0-9]{4,20}", $admin_usuario)){

        echo '
             <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The USER doesnt match with the required format.
            </div>  
        ';
        exit();

    }    

    if(!verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $admin_clave)){

        echo '
             <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                Your KEY doesnt match with the required format.
            </div>  
        ';
        exit();

    }      
    
    
    # Verifying admin

    $check_admin=conexion();
    $check_admin=$check_admin->query("SELECT usuario_usuario, usuario_clave FROM usuario WHERE usuario_usuario='$admin_usuario' AND usuario_id='".$_SESSION['id']."'");

    if($check_admin->rowCount()==1){
        $check_admin=$check_admin->fetch();
        if($check_admin['usuario_usuario']!=$admin_usuario || !password_verify($admin_clave, $check_admin['usuario_clave'])){
            echo '
                <div class="notification is-danger is-light">
                    <strong>There was an unexpected error</strong><br>
                    USER or KEY of administrator incorrect.
                </div>  
            ';
            exit();
        }
    } else{
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                USER or KEY of administrator incorrect.
            </div>  
        ';
        exit();
    }
    $check_admin=null;

    # storing data

    $nombre=limpiar_cadena($_POST['usuario_nombre']);
    $apellido=limpiar_cadena($_POST['usuario_apellido']);

    $usuario=limpiar_cadena($_POST['usuario_usuario']);
    $email=limpiar_cadena($_POST['usuario_email']);

    $clave_1=limpiar_cadena($_POST['usuario_clave_1']);
    $clave_2=limpiar_cadena($_POST['usuario_clave_2']);

    if($nombre == "" || $apellido== "" || $usuario== "" || $clave_1== "" || $clave_2==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                You didnt fill in all required fields
            </div>
            ';
        exit();
    }

    # Verification of data integrity

    if(!verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,40}", $nombre)){

        echo '
             <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The NAME doesnt match with the required format.
            </div>  
        ';
        exit();

    }


    if(!verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $apellido)){

        echo '
             <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The LASTNAME doesnt match with the required format.
            </div>  
        ';
        exit();
        
    }   

    if(!verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)){

        echo '
             <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The USERNAME doesnt match with the required format.
            </div>  
        ';
        exit();
        
    }   

        # Verificaction of email

    if($email!="" && $email!=$datos['usuario_email']){
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
    }

    # Verifying user

    if($usuario!=$datos['usuario_usuario']){
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
    }

    # Verifying passwords
    if($clave_1!="" || $clave_2!=""){
        if(!verificar_datos("[a-zA-Z0-9\$@\.\-]{7,100}", $clave_1) || !verificar_datos("[a-zA-Z0-9\$@\.\-]{7,100}",$clave_2)){

            echo '
                 <div class="notification is-danger is-light">
                    <strong>There was an unexpected error</strong><br>
                    The KEYS doesnt match with the required format.
                    
                </div>  
    
            '."$clave_1"."$clave_2";
            exit();
            
        } else{
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
        }
        
    }else{
        $clave=$datos['usuario_clave'];
    }
    // Actualizar datos
    $actualizar_usuario=conexion();
    $actualizar_usuario=$actualizar_usuario->prepare("UPDATE usuario SET usuario_nombre=:nombre, usuario_apellido=:apellido, usuario_usuario=:usuario, usuario_email=:email, usuario_clave=:clave WHERE usuario_id=:id");

    $marcadores = [
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":usuario" => $usuario,
        ":clave" => $clave,
        ":email" => $email,
        ":id" => $id
    ];

    if($actualizar_usuario->execute($marcadores)){
        echo '
             <div class="notification is-info is-light">
                <strong>¡USURARIO ACTUALIZADO!</strong><br>
                the USER has been updated successfully
            </div>  
        ';
    }
    else{
        echo '
             <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                the USER cannot be updated, please try again.
            </div>  
        ';
    }
    $actualizar_usuario=null;

