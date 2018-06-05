<?php


require_once 'DBConnection.php';
require_once 'Categoria.php';

class CategoriaCrud
{
    private $conexao;
    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }


    public function getCategoria($id)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID
        //FAZER A CONSULTA
        $sql = 'select * from categoria where id_categoria=' . $id;
        $result = $this->conexao->query($sql);
        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $categoria = $result->fetch(PDO::FETCH_ASSOC);
        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetocat = new Categoria($categoria['id_categoria'], $categoria['nome_categoria'], $categoria['descricao_categoria']);
        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetocat;
    }
    public function getCategorias()
    {
        $sql = "SELECT * FROM categoria";
        $result = $this->conexao->query($sql);
        $categorias = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categorias as $categoria) {
            $id = $categoria['id_categoria'];
            $nome = $categoria['nome_categoria'];
            $descricao = $categoria['descricao_categoria'];
            $obj = new Categoria($id, $nome, $descricao);
            $listaCategoria[] = $obj;
        }
        return $listaCategoria;
    }
}