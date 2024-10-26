<?php

namespace App\Db;

class Db {

    

    function insert($connection, $table_name, $atts_values){
        $slq_verifica_existe = "";
    }

    function execute($conexao, $sql){
        return mysqli_query($conexao, $sql);
    }

}