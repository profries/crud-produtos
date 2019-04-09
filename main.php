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
        $conexao = "pgsql:host=localhost;dbname=app_produtos";
        $usuario = "postgres";
        $senha = "postgresql";
        $pdo = new PDO($conexao, $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES,false);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $q = "SELECT * FROM produto WHERE id=:id";
        $comando = $pdo->prepare($q);
        $comando->bindParam("id", $id);
        $comando->execute();
        $obj = $comando->fetch(PDO::FETCH_OBJ);
        return($obj);
    }

    function listar(){
        $conexao = "pgsql:host=localhost;dbname=app_produtos";
        $usuario = "postgres";
        $senha = "postgresql";
        $pdo = new PDO($conexao, $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES,false);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $q = "SELECT * FROM produto";
        $comando = $pdo->prepare($q);
        $comando->execute();
        $objs = array();
        while($linha = $comando->fetch(PDO::FETCH_OBJ))
        {
            $objs[] = $linha;
        }
        return($objs);
    }

    function deletar($id)
    {
        $conexao = "pgsql:host=localhost;dbname=app_produtos";
        $usuario = "postgres";
        $senha = "postgresql";
        $pdo = new PDO($conexao, $usuario, $senha);

        $qdeletar = "DELETE FROM produto WHERE id=:id";
        $comando = $pdo->prepare($qdeletar);

        $comando->bindParam(':id',$id);

        $comando->execute();
        
    }

    function atualizar($id,Produto $produtoAlterado)
    {
        $conexao = "pgsql:host=localhost;dbname=app_produtos";
        $usuario = "postgres";
        $senha = "postgresql";
        $pdo = new PDO($conexao, $usuario, $senha);

        $qAtualizar = "UPDATE produto SET nome=:nome, preco=:preco WHERE id=:id";            
        $comando = $pdo->prepare($qAtualizar);

        $comando->bindParam(":nome",$produtoAlterado->nome);
        $comando->bindParam(":preco",$produtoAlterado->preco);
        $comando->bindParam(":id",$id);
        $comando->execute(); 
        
    }


    //Visualizem se salvou corretamente
    //O id é 0 porque é auto-increment.
//  inserir(new Produto(0,"mesa",539.20));
//  inserir(new Produto(0,"cadeira",135.30));
//    inserir(new Produto(0,"TV",3000));

//    print_r(buscarPorId(3));

//    deletar(3);
    
    $obj = buscarPorId(2);
    $produto = new Produto(0,$obj->nome,floatval($obj->preco));
    $produto->nome = "cadeira X";
    atualizar(2,$produto);
    
    print_r(listar());


?>