<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/db/conexao.php';

class Produto
{
    public $id_produto;
    public $nome_produto;
    public $preco;
    public $img_produto;

    public function __construct($id_produto = false)
    {
        if ($id_produto) {
            $this->id_produto = $id_produto;
            $this->carregar();
        }
    }

    public function carregar()
    {
        $query = "SELECT nome_produto, preco, img_produto FROM produto WHERE id_produto = :id_produto";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_produto', $this->id_produto);
        $stmt->execute();

        $produto = $stmt->fetch();
        $this->nome_produto = $produto['nome_produto'];
        $this->preco = $produto['preco'];
        $this->img_produto = $produto['img_produto'];
    }

    public function criar()
    {
        $query = "INSERT INTO produto (nome_produto, preco, img_produto) VALUES (:nome_produto, :preco, :img_produto)";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome_produto', $this->nome_produto);
        $stmt->bindValue(':preco', $this->preco);
        $stmt->bindValue(':img_produto', $this->img_produto);
        $stmt->execute();
        $this->id_produto = $conexao->lastInsertId();
        return $this->id_produto;
    }

    public static function listar()
    {
        $query = "SELECT * FROM produto";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $lista = $stmt->fetchAll();
        return $lista;
    }

    public function editar()
    {
        $query = "UPDATE produto SET nome_produto = :nome_produto, preco = :preco, img_produto = :img_produto WHERE id_produto = :id_produto";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":nome_produto", $this->nome_produto);
        $stmt->bindValue(":preco", $this->preco);
        $stmt->bindValue(":img_produto", $this->img_produto);
        $stmt->bindValue(":id_produto", $this->id_produto);
        $stmt->execute();
    }

    public function deletar()
    {
        $query = "DELETE FROM produto WHERE id_produto = :id_produto";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_produto', $this->id_produto);
        $stmt->execute();
    }
}
