<?php
    include_once('Produto.php');

    $produtos = [];



    function inserir(Produto $produto){
        //inserir no banco postgresql
        $conexao = "pgsql:host=localhost;dbname=app_produtos";
        $usuario = "postgres";
        $senha = "postgresql";

        $pdo = new PDO($conexao,$usuario,$senha);

        $comando = $pdo->prepare("INSERT INTO produto(nome,preco) VALUES (:nome, :preco)");

        $comando->bindParam(':nome',$produto->nome);
        $comando->bindParam(':preco',$produto->preco);

        $comando->execute();

        var_dump($pdo->lastInsertId());
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


    //Visualizem se salvou corretamente
    //O id é 0 porque é auto-increment.
    inserir(new Produto(0,"mesa",539.20));
    inserir(new Produto(0,"cadeira",135.30));
    inserir(new Produto(0,"TV",3000));
    inserir(new Produto(0,"radio",230));

    /*print_r(buscarPorId(1));

    deletar(1);
    
    $produto = buscarPorId(4);
    $produto->nome="dock";
    atualizar(4,$produto);
    
    print_r(listar());*/


?>