<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 13/04/18
 * Time: 14:32
 */
require_once 'DBConnection.php';
require_once 'Produto.php';
class ProdutoCrud
{
    private $conexao;
    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }
    public function getProduto(int $id_produto)
    {
        //RETORNA UM PRODUTO, DADO UM ID
        //FAZER A CONSULTA
        $sql = 'select * from produto where id_produto=' . $id_produto;
        $result = $this->conexao->query($sql);
        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $produto = $result->fetch(PDO::FETCH_ASSOC);
        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoprod = new Produto($produto['id_produto'], $produto['nome_produto'], $produto['descricao_produto'],  $produto['preco_produto'],$produto['foto_produto'], $produto['id_produto']);
        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoprod;
    }
    public function getProdutos()
    {
        $sql = "SELECT * FROM produto";
        $result = $this->conexao->query($sql);
        $produtos = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($produtos as $produto){
            $id_produto = $produto['id_produto'];
            $nome = $produto['nome_produto'];
            $descricao = $produto['descricao_produto'];
            $foto = $produto['foto_produto'];
            $preco = $produto['preco_produto'];
            $id_categoria = $produto['id_categoria'];
            $obj = new Produto($id_produto, $nome, $descricao, $foto,$preco,$id_categoria);
            $listaProduto[] = $obj;
        }
        return $listaProduto;
    }
    public function getProdCat($id)
    {
        $sql = "SELECT * FROM produto WHERE id_categoria = $id";
        $result = $this->conexao->query($sql);
        $produtos = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($produtos as $produto){
            $id_produto = $produto['id_produto'];
            $nome = $produto['nome_produto'];
            $descricao = $produto['descricao_produto'];
            $foto = $produto['foto_produto'];
            $preco = $produto['preco_produto'];
            $id_categoria = $produto['id_categoria'];
            $obj = new Produto($id_produto, $nome, $descricao, $foto,$preco,$id_categoria);
            $listaProduto[] = $obj;
        }
        return $listaProduto;
    }
    public function insertProdutos(Produto $prod)
    {
        //EFETUA A CONEXAO
        $this->conexao = DBConnection::getConexao();
        //MONTA O TEXTO DA INSTRUÇÂO SQL
        $sql = "INSERT INTO produto (nome_produto, descricao_produto, foto_produto, preco_produto, id_categoria) 
                values ('{$prod->getNome()}','{$prod->getDescricao()}' ,'{$prod->getFoto()}','{$prod->getPreco()}','{$prod->getIdcategoria()}')";
        try {//TENTA EXECUTAR A INSTRUCAO
            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }
    public function deleteProduto($id)
    {
        //EFETUA A CONEXAO
        $this->conexao = DBConnection::getConexao();
        //MONTA O TEXTO DA INSTRUÇÂO SQL
        $sql = "DELETE FROM produto WHERE id_produto = $id";
        try {//TENTA EXECUTAR A INSTRUCAO
            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }
    public function updateProduto(Produto $cat)
    {
        //MONTA O TEXTO DA INSTRUÇÃO SQL DE INSERT
        $sql = "UPDATE produto 
                SET nome_produto ='{$cat->getNome()}', descricao_produto = '{$cat->getDescricao()}' 
                WHERE id_produto ='{$cat->getId()}'";
        try {//TENTA EXECUTAR A INSTRUCAO
            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }
}