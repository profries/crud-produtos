<?php
    include_once('Produto.php');

    $produtos = [];



    function inserir(Produto $produto){
        $GLOBALS['produtos'][] = $produto;
    }

    function buscarPorId($id){
        foreach($GLOBALS['produtos'] as $prod){
            if($prod->id == $id)
                return $prod;        
        }
        return null;
    }

    function listar(){
        return $GLOBALS['produtos'];        
    }



    inserir(new Produto(1,"mesa",539.20));
    inserir(new Produto(2,"cadeira",135.30));

    print_r(buscarPorId(1));
    print_r(listar());


?>