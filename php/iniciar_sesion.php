<?php

    # Almacenando datos
    $usuario=limpiar_cadena($_POST['login_usuario']);
    $clave=limpiar_cadena($_POST['login_clave']);


    #usuario y contraseña a comparar
    $usuario_login = "sek";
    $clave_login = "fuckthem"
    # Verificando campos obligatorios 

    if($usuario== "" || $clave==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                no se ha ingresado el usuario o la contraseña
            </div>
            ';
        exit();
    }

    



    if($usuario == ){
        $check_user=$check_user->fetch();

        if($check_user['usuario_usuario']== $usuario  && password_verify($clave, $check_user['usuario_clave'])){

            $_SESSION['id']=$check_user['usuario_id'];
            $_SESSION['nombre']=$check_user['usuario_nombre'];
            $_SESSION['apellido']=$check_user['usuario_apellido'];
            $_SESSION['usuario']=$check_user['usuario_usuario'];


            if(headers_sent()){
                echo "<script> window.location.href='index.php?vista=home'; </script>";
            }else{
                header("Location: index.php?vista=home");
            }



        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>There was an unexpected error</strong><br>
                    Incorrect USERNAME or PASSWORD.
                </div>  
            ';
        }
    }else{

        echo '
             <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                Incorrect USERNAME or PASSWORD.
            </div>  
        ';
    }
    $check_user=null;