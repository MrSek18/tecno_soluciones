<?php

    $user_id_del=limpiar_cadena($_GET['user_id_del']);


    // verificando usuario

    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT usuario_id FROM usuario WHERE usuario_id='$user_id_del'");

    if($check_usuario->rowCount()==1){
        
        // verificando usuario

        $check_productos=conexion();
        $check_productos=$check_productos->query("SELECT usuario_id FROM producto WHERE usuario_id='$user_id_del' LIMIT 1");

        if($check_productos->rowCount()<=0){

            $eliminar_usuario=conexion();
            $eliminar_usuario=$eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_id=:id");

            $eliminar_usuario->execute([":id"=>$user_id_del]);

            if($eliminar_usuario->rowCount()==1){
                echo '
                <div class="notification is-info is-light">
                    <strong>¡User deleted!</strong><br>
                    User data was successfully deleted.
                </div> 
                ';
            }
            else{
                echo '
                <div class="notification is-danger is-light">
                    <strong>There was an unexpected error</strong><br>
                    Could not delete the user, please try again
                </div> 
                ';
            }
            $eliminar_usuario=null;
        }else{
            echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                Cannot delete the user (has registered products)
            </div> 
            ';
        }

        $check_productos=null;

    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The user you trynna eliminate doesnt exist
            </div> 
        ';
    }

    $check_usuario=null;
