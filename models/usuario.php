<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/db/conexao.php';
session_start();

class Usuario
{
    public $id_usuario;
    public $nome_usuario;
    public $img_usuario;
    public $email;
    public $senha;
    public $nv_acesso;

    public function __construct($id_usuario = false)
    {
        if ($id_usuario) {
            $this->id_usuario = $id_usuario;
            $this->carregar();
        }
    }

    public function carregar()
    {
        $query = "SELECT nome_usuario, img_usuario, email, senha, nv_acesso FROM usuario WHERE id_usuario = :id_usuario";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_usuario', $this->id_usuario);
        $stmt->execute();

        $usuario = $stmt->fetch();
        $this->nome_usuario = $usuario['nome_usuario'];
        $this->img_usuario = $usuario['img_usuario'];
        $this->email = $usuario['email'];
        $this->senha = $usuario['senha'];
        $this->nv_acesso = $usuario['nv_acesso'];
    }

    public function criar()
    {
        $query = "INSERT INTO usuario (nome_usuario, img_usuario, email, senha) VALUES (:nome_usuario, :img_usuario, :email, :senha)";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome_usuario', $this->nome_usuario);
        $stmt->bindValue(':img_usuario', $this->img_usuario);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->execute();
        $this->id_usuario = $conexao->lastInsertId();
        return $this->id_usuario;
    }

    public static function listar()
    {
        $query = "SELECT * FROM usuario";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $lista = $stmt->fetchAll();
        return $lista;
    }

    public function editar()
    {
        $query = "UPDATE usuario SET nome_usuario = :nome_usuario, img_usuario = :img_usuario, email = :email, senha = :senha, nv_acesso = :nv_acesso WHERE id_usuario = :id_usuario";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":nome_usuario", $this->nome_usuario);
        $stmt->bindValue(":img_usuario", $this->img_usuario);
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":senha", $this->senha);
        $stmt->bindValue(":nv_acesso", $this->nv_acesso);
        $stmt->bindValue(":id_usuario", $this->id_usuario);
        $stmt->execute();
    }

    public function deletar()
    {
        $query = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_usuario', $this->id_usuario);
        $stmt->execute();
    }

    public static function logar($email, $senha)
    {
        $query = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0 && password_verify($senha, $registro['senha'])) {

            session_destroy();
            session_start();
            session_regenerate_id();

            $_SESSION['usuario']['nome'] = $registro['nome_usuario'];
            $_SESSION['usuario']['email'] = $registro['email'];
            $_SESSION['usuario']['nv_acesso'] = $registro['nv_acesso'];
            $_SESSION['usuario']['inicio'] = time();
            $_SESSION['usuario']['expira'] = 900;

            header("Location: /carrinho/index.php");
        } else {
            setcookie('erro', 'Email/Senha incorretos', time() + 3600, '/');
            header('Location: /carrinho/views/login.php');
        }
    }
}
