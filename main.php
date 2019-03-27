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

    function deletar($id)
    {
        foreach($GLOBALS['produtos'] as $i => $produto) 
        {
            if($produto->id === $id)
                array_splice($GLOBALS['produtos'],$i,1);    
        }
    }

    function atualizar($id,Produto $produtoAlterado)
    {
        foreach($GLOBALS['produtos'] as $i => $produto) 
        {
            if($produto->id === $id)
            {
                $produto->nome = $produtoAlterado->nome;    
                $produto->preco = $produtoAlterado->preco;
            }
        }
        
    }


    inserir(new Produto(1,"mesa",539.20));
    inserir(new Produto(2,"cadeira",135.30));
    inserir(new Produto(3,"TV",3000));
    inserir(new Produto(4,"radio",230));

    print_r(buscarPorId(1));

    deletar(1);
    
    $produto = buscarPorId(4);
    $produto->nome="dock";
    atualizar(4,$produto);
    
    print_r(listar());


?>