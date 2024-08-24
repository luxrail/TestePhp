<?php
require_once 'config.php';

class Categories
{
    public $id;
    public $name;
    public $created;
    public $updated;

    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(server, user, pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Database connection error: ' . $e->getMessage());
        }
    }

    public function listAllCategories(): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM categories");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            // Log the error message for debugging
            error_log('Database Error: ' . $e->getMessage());
            return [];
        }
    }

    public function insertCategory(): string
    {
        try {
            if (isset($_POST["name"]) && !empty($_POST["name"])) {
                $this->name = $_POST["name"];
                $this->created = date('Y-m-d H:i:s');

                $stmt = $this->pdo->prepare("INSERT INTO categories (name, created) VALUES (:name, :created)");
                $stmt->execute([
                    ':name' => $this->name,
                    ':created' => $this->created
                ]);

                if ($stmt->rowCount() > 0) {
                    return "Categoria adicionada com sucesso!";
                } else {
                    return "Erro ao adicionar a categoria.";
                }
            } else {
                return "O nome da categoria é obrigatório.";
            }
        } catch (PDOException $e) {
            // Log the error message for debugging
            error_log('Database Error: ' . $e->getMessage());
            return 'Erro no banco de dados: ' . $e->getMessage();
        } catch (Exception $e) {
            // Log the error message for debugging
            error_log('General Error: ' . $e->getMessage());
            return 'Erro: ' . $e->getMessage();
        }
    }

    public function editCategory(): string
    {
        try {
            if (isset($_POST["save"]) && isset($_GET["id"])) {
                $this->id = $_GET["id"];
                $this->name = $_POST["name"];
                $this->updated = date('Y-m-d H:i:s');

                $stmt = $this->pdo->prepare(
                    "UPDATE categories 
                     SET name = :name, updated = :updated 
                     WHERE id = :id"
                );

                $stmt->execute([
                    ':id' => $this->id,
                    ':name' => $this->name,
                    ':updated' => $this->updated
                ]);

                if ($stmt->rowCount() > 0) {
                    return "Categoria atualizada com sucesso!";
                } else {
                    return "Nenhuma alteração foi feita.";
                }
            } else {
                return "Dados incompletos para edição.";
            }
        } catch (PDOException $e) {
            // Log the error message for debugging
            error_log('Database Error: ' . $e->getMessage());
            return 'Erro no banco de dados: ' . $e->getMessage();
        } catch (Exception $e) {
            // Log the error message for debugging
            error_log('General Error: ' . $e->getMessage());
            return 'Erro: ' . $e->getMessage();
        }
    }

    public function listCategoryById($id): ?object
    {
        try {
            if (isset($id)) {
                $this->id = $id;

                $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = :id");
                $stmt->execute([':id' => $this->id]);

                if ($stmt->rowCount() > 0) {
                    return $stmt->fetchObject();
                }
            }
            return null;
        } catch (PDOException $e) {
            // Log the error message for debugging
            error_log('Database Error: ' . $e->getMessage());
            return null;
        }
    }

    public function deleteCategory($id): string
    {
        try {
            if (isset($id)) {
                $this->id = $id;

                $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM products WHERE category_id = :id");
                $stmt->execute([':id' => $this->id]);
                $productCount = $stmt->fetchColumn();

                if ($productCount > 0) {
                    return "Não é possível excluir a categoria, pois existem produtos vinculados a ela.";
                }

                $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = :id");
                $stmt->execute([':id' => $this->id]);

                if ($stmt->rowCount() > 0) {
                    return "Categoria excluída com sucesso!";
                } else {
                    return "Erro ao excluir a categoria.";
                }
            }
            return "ID da categoria não fornecido.";
        } catch (PDOException $e) {
            // Log the error message for debugging
            error_log('Database Error: ' . $e->getMessage());
            return 'Erro no banco de dados: ' . $e->getMessage();
        }
    }
}
?>
