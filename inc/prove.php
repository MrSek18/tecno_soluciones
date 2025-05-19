<?php

    function verificar_datos($filtro, $cadena) {
        return preg_match("/^" . $filtro . "$/", $cadena);
    }

    $clave_1 = "asdf123456";
    $clave_2 = "asdf123456";

    // Verificar formato de las claves
    if (!verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_1) || !verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_2)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>There was an unexpected error</strong><br>
                The KEYS doesnt match with the required format.
            </div>  
        ';
        exit();
    } else {
        echo "Las claves cumplen con el formato.";
    }