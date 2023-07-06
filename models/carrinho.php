<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/db/conexao.php';

class Carrinho
{
    public $id_carrinho;
    public $quantidade;
    public $id_usuario;
    public $id_produto;

    public function __construct($id_carrinho = false)
    {
        if ($id_carrinho) {
            $this->id_carrinho = $id_carrinho;
            $this->carregar();
        }
    }

    public function carregar()
    {
        $query = "SELECT quantidade, id_usuario, id_produto FROM carrinho WHERE id_carrinho = :id_carrinho";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_carrinho', $this->id_carrinho);
        $stmt->execute();

        $carrinho = $stmt->fetch();
        $this->quantidade = $carrinho['quantidade'];
        $this->id_usuario = $carrinho['id_usuario'];
        $this->id_produto = $carrinho['id_produto'];
    }

    public function criar()
    {
        $query = "INSERT INTO carrinho (quantidade, id_usuario, id_produto) VALUES (:quantidade, :id_usuario, :id_produto)";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':quantidade', $this->quantidade);
        $stmt->bindValue(':id_usuario', $this->id_usuario);
        $stmt->bindValue(':id_produto', $this->id_produto);
        $stmt->execute();
        $this->id_carrinho = $conexao->lastInsertId();
        return $this->id_carrinho;
    }

    public static function listar()
    {
        $query = "SELECT * FROM carrinho";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $lista = $stmt->fetchAll();
        return $lista;
    }

    public function editar()
    {
        $query = "UPDATE carrinho SET quantidade = :quantidade, id_usuario = :id_usuario, id_produto = :id_produto WHERE id_carrinho = :id_carrinho";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":quantidade", $this->quantidade);
        $stmt->bindValue(":id_usuario", $this->id_usuario);
        $stmt->bindValue(":id_produto", $this->id_produto);
        $stmt->bindValue(":id_carrinho", $this->id_carrinho);
        $stmt->execute();
    }

    public function deletar()
    {
        $query = "DELETE FROM carrinho WHERE id_carrinho = :id_carrinho";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_carrinho', $this->id_carrinho);
        $stmt->execute();
    }
}
