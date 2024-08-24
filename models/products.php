<?php
require_once 'config.php';

class Products
{
    private $pdo;

    public $id;
    public $categoryId;
    public $name;
    public $created;
    public $updated;

    public function __construct()
    {
        $this->pdo = new PDO(server, user, pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function listAllProducts(): array
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT p.*, c.name as category_name 
                 FROM products p 
                 INNER JOIN categories c ON c.id = p.category_id 
                 ORDER BY p.id"
            );
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function insertProduct()
    {
        try {
            if (isset($_POST["name"])) {
                $this->categoryId = intval($_POST["category_id"]);
                $this->name = $_POST["name"];
                $this->created = date('Y-m-d H:i:s');

                $stmt = $this->pdo->prepare(
                    "INSERT INTO products (category_id, name, created) 
                     VALUES (:category_id, :name, :created)"
                );

                $stmt->execute([
                    ':category_id' => $this->categoryId,
                    ':name' => $this->name,
                    ':created' => $this->created
                ]);

                if ($stmt->rowCount() > 0) {
                    return "Produto inserido com sucesso!";
                } else {
                    return "Erro ao inserir o produto.";
                }
            } else {
                return "Nome do produto não fornecido.";
            }
        } catch (PDOException $e) {
            return 'Erro no banco de dados: ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Erro geral: ' . $e->getMessage();
        }
    }

    public function editProduct()
    {
        try {
            if (isset($_POST["save"])) {
                $this->id = $_GET["id"];
                $this->categoryId = intval($_POST["category_id"]);
                $this->name = $_POST["name"];
                $this->updated = date('Y-m-d H:i:s');

                $stmt = $this->pdo->prepare(
                    "UPDATE products 
                     SET category_id = :category_id, name = :name, updated = :updated 
                     WHERE id = :id"
                );

                $stmt->execute([
                    ':id' => $this->id,
                    ':category_id' => $this->categoryId,
                    ':name' => $this->name,
                    ':updated' => $this->updated
                ]);

                if ($stmt->rowCount() > 0) {
                    return "Produto atualizado com sucesso!";
                } else {
                    return "Erro ao atualizar o produto.";
                }
            } else {
                return "Dados não enviados corretamente.";
            }
        } catch (PDOException $e) {
            return 'Erro no banco de dados: ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Erro geral: ' . $e->getMessage();
        }
    }

    public function listProductById($id)
    {
        try {
            if (isset($id)) {
                $this->id = $id;

                $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
                $stmt->execute([':id' => $this->id]);

                if ($stmt->rowCount() > 0) {
                    return $stmt->fetchObject();
                } else {
                    return null;
                }
            }
        } catch (PDOException $e) {
            echo 'Erro no banco de dados: ' . $e->getMessage();
        }
    }

    public function deleteProduct($id)
    {
        try {
            if (isset($id)) {
                $this->id = $id;
    
                $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
                $stmt->execute([':id' => $this->id]);
    
                return $stmt->rowCount() > 0 ? "Produto excluído com sucesso!" : "Erro ao excluir o produto.";
            }
        } catch (PDOException $e) {
            return 'Erro no banco de dados: ' . $e->getMessage();
        }
    }
    
}
