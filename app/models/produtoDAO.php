<?php

namespace app\models;

use PDO;
use PDOException;

class ProdutoDAO
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function insert(array $produto): bool
    {
        $sql = 'INSERT INTO produtos (nome, descricao, preco, estoque, categoria_id) VALUES (:nome, :descricao, :preco, :estoque, :categoria_id)';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome', $produto['nome']);
        $stmt->bindValue(':descricao', $produto['descricao']);
        $stmt->bindValue(':preco', $produto['preco']);
        $stmt->bindValue(':estoque', $produto['estoque']);
        $stmt->bindValue(':categoria_id', $produto['categoria_id']);

        return $stmt->execute();
    }

    public function update(int $id, array $produto): bool
    {
        $sql = 'UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, estoque = :estoque, categoria_id = :categoria_id WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome', $produto['nome']);
        $stmt->bindValue(':descricao', $produto['descricao']);
        $stmt->bindValue(':preco', $produto['preco']);
        $stmt->bindValue(':estoque', $produto['estoque']);
        $stmt->bindValue(':categoria_id', $produto['categoria_id']);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM produtos WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function findById(int $id): ?array
    {
        $sql = 'SELECT id, nome, descricao, preco, estoque, categoria_id FROM produtos WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        return $produto === false ? null : $produto;
    }

    // No findAll por exemplo:
    public function findAll(): array
    {
        // Adicionei o campo 'imagem' na query
        $sql = 'SELECT id, nome, descricao, preco, estoque, categoria_id, imagem FROM produtos ORDER BY nome';
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByCategoria(int $categoriaId): array
    {
        $sql = 'SELECT id, nome, descricao, preco, estoque, categoria_id FROM produtos WHERE categoria_id = :categoria_id ORDER BY nome';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':categoria_id', $categoriaId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count(): int
    {
        $sql = 'SELECT COUNT(*) as total FROM produtos';

        $stmt = $this->conn->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) ($result['total'] ?? 0);
    }
}

