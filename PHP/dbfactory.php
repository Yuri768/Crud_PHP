<?php

    try{
        $mysqli = new mysqli("localhost", "root", "root", "prog_2");
    }catch(mysqli_sql_exception $e){
        error_log('Erro ao conectar-se ao banco: ' . $e->getMessage());
        die("Erro ao tentar conectar-se ao banco");
        exit();
    }
    
    return $mysqli

?>