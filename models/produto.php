<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/db/conexao.php';

class Produto
{
    public $id_produto;
    public $nome_produto;
    public $preco;
    public $img_produto;
    public $id_categoria;

    public $quantidade; //nao vai pro banco, so para controlar os cookies

    public function __construct($id_produto = false)
    {
        if ($id_produto) {
            $this->id_produto = $id_produto;
            $this->carregar();
        }
    }

    public function carregar()
    {
        $query = "SELECT nome_produto, preco, img_produto, id_categoria FROM produto WHERE id_produto = :id_produto";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_produto', $this->id_produto);
        $stmt->execute();

        $produto = $stmt->fetch();
        $this->nome_produto = $produto['nome_produto'];
        $this->preco = $produto['preco'];
        $this->img_produto = $produto['img_produto'];
        $this->id_categoria = $produto['id_categoria'];
    }

    public function criar()
    {
        $query = "INSERT INTO produto (nome_produto, preco, img_produto, id_categoria) VALUES (:nome_produto, :preco, :img_produto, :id_categoria)";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome_produto', $this->nome_produto);
        $stmt->bindValue(':preco', $this->preco);
        $stmt->bindValue(':img_produto', $this->img_produto);
        $stmt->bindValue(':id_categoria', $this->id_categoria);
        $stmt->execute();
        $this->id_produto = $conexao->lastInsertId();
        return $this->id_produto;
    }

    public static function listar()
    {
        $query = "SELECT p.*, c.nome_categoria FROM produto p
              JOIN categoria c ON p.id_categoria = c.id_categoria";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public static function listarUltimos()
    {
        $query = "SELECT * FROM produto ORDER BY id_produto DESC LIMIT 3";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $lista = $stmt->fetchAll();
        return $lista;
    }

    public static function listarPorCategoria($categoria){
        $query = "SELECT p.*, c.nome_categoria FROM produto p
        JOIN categoria c ON p.id_categoria = c.id_categoria WHERE p.id_categoria = :id_categoria";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_categoria', $categoria);
        $stmt->execute();
        $lista = $stmt->fetchAll();
        return $lista;
    }

    public function editar()
    {
        $query = "UPDATE produto SET nome_produto = :nome_produto, preco = :preco, id_categoria = :id_categoria WHERE id_produto = :id_produto";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":nome_produto", $this->nome_produto);
        $stmt->bindValue(":preco", $this->preco);
        $stmt->bindValue(":id_categoria", $this->id_categoria);
        $stmt->bindValue(":id_produto", $this->id_produto);
        $stmt->execute();
    }

    public function editarImagem()
    {
        $query = "UPDATE produto SET nome_produto = :nome_produto, preco = :preco, img_produto = :img_produto, id_categoria = :id_categoria WHERE id_produto = :id_produto";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":nome_produto", $this->nome_produto);
        $stmt->bindValue(":preco", $this->preco);
        $stmt->bindValue(":img_produto", $this->img_produto);
        $stmt->bindValue(":id_categoria", $this->id_categoria);
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

    public function getNomeCategoria()
    {
        $query = "SELECT nome_categoria FROM categoria WHERE id_categoria = :id_categoria";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_categoria', $this->id_categoria);
        $stmt->execute();

        $categoria = $stmt->fetch();
        return $categoria['nome_categoria'];
    }
}
