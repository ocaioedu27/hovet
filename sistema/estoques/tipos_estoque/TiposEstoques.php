
<?php

class TiposEstoques{

    private $id;
    private $tipo;

    function TiposEstoques($id, $tipo){
        $this->$id = $id;
        $this->$tipo = $tipo;
    }

    function getId(){
        return $this->$id;
    }

    function getTipo(){
        return $this->$tipo;
    }

    function setId($value){
        $this->$id = $value;
        return $this->$id;
    }

    function setTipo($value){
        $this->$tipo = $value;
        return $this->$tipo;
    }

    function criaTiposEstoques($nome_tipo_estoque){
        $sql = "insert into estoques (id, tipo) values (?,?)";
        
    }

}
