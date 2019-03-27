<?php

    class Produto{
        public $id;
        public $nome;
        public $preco;

        function __construct($id,$nome,$preco){
            $this->id = $id;
            $this->nome = $nome;
            $this->preco = $preco;
        }
    }

?>
