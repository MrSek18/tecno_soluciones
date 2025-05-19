<?php
    $category_id_del=limpiar_cadena($_GET['category_id_del']);

    // verificando categoria
    $check_categoria=conexion();
    $check_categoria=$check_categoria->query("SELECT categoria_id FROM categoria WHERE categoria_id='$category_id_del'");

    if($check_categoria->rowCount()==1){

        // verifyng if the category has products
        $check_productos=conexion();
        $check_productos=$check_productos->query("SELECT categoria_id FROM producto WHERE categoria_id='$category_id_del' LIMIT 1");

        if($check_productos->rowCount()<=0){

            $eliminar_categoria=conexion();
            $eliminar_categoria=$eliminar_categoria->prepare("DELETE FROM categoria WHERE categoria_id=:id");

            $eliminar_categoria->execute([":id"=>$category_id_del]);
            
            
            if($eliminar_categoria->rowCount()==1){
                echo '
                <div class="notification is-info is-light">
                    <strong>¡User deleted!</strong><br>
                    category was successfully deleted.
                </div> 
                ';
            }
            else{
                echo '
                <div class="notification is-danger is-light">
                    <strong>There was an unexpected error</strong><br>
                    Could not delete the category, please try again
                </div> 
                ';
            }
            $eliminar_categoria=null;

        }else{
            echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                Cannot delete the category (has registered products)
            </div> 
            ';
        }
        $check_productos=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The category you trynna eliminate doesnt exist
            </div> 
        ';
    }
    $check_categoria=null;