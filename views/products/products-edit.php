<?php
session_start();
header("Content-type:text/html; charset=utf8");
require_once "../../models/products.php";
require_once "../../models/categories.php";

$products = new Products();
$categories = new Categories();

$list_categories = $categories->listAllCategories();

$list = null;
if (isset($_GET['id'])) {
    $list = $products->listProductById($_GET['id']);
}

$message = '';

if (isset($_POST['save'])) {
    $message = $products->editProduct();
    $_SESSION['message'] = $message; // Armazena a mensagem na sessão
    header('Location: index.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos - Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include('../navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Produto
                            <a href="index-products.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-info">
                                <?= htmlspecialchars($message) ?>
                            </div>
                        <?php endif; ?>
                        <form action="products-edit.php?id=<?php echo ($list->id); ?>" method="POST">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Categoria</label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <?php if ($list_categories && count($list_categories) > 0) : ?>
                                        <option value="" disabled selected>Selecione uma categoria</option>
                                        <?php foreach ($list_categories as $category) : ?>
                                            <option value="<?php echo ($category->id); ?>" 
                                                <?php echo ($category->id == $list->category_id) ? 'selected' : ''; ?>>
                                                <?php echo ($category->name); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="" disabled>Sem categorias disponíveis</option>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label" required>Nome</label>
                                <input type="text" id="name" name="name" value="<?php echo ($list->name); ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success btn-block" name="save">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
