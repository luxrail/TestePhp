<?php
session_start();
require_once "../../models/products.php";

$products = new Products();
$list_products = $products->listAllProducts();

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);

if (isset($_GET["idproduct"])) {
    $message = $products->deleteProduct($_GET['idproduct']);
    $_SESSION['message'] = $message;
    header('Location: index.php');
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include('../navbar.php')?>
    <div class="container mt-4">
    <?php if (!empty($message)): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Produtos
                            <a href="products-create.php" class="btn btn-primary float-end">Novo Produto</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Data Criação</th>
                                    <th scope="col">Data Atualização</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($list_products) : ?>
                                <?php foreach ($list_products as $product) : ?>
                                <tr>
                                    <td><?php echo $product->id; ?></td>
                                    <td><?php echo $product->category_name; ?></td>
                                    <td><?php echo $product->name; ?></td>
                                    <td><?php echo $product->created; ?></td>
                                    <td><?php echo $product->updated; ?></td>
                                    <td>
                                        <a href="products-edit.php?id=<?php echo $product->id; ?>"
                                            class="btn btn-success">Alterar</a>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                            data-id="<?php echo $product->id; ?>">Excluir</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else : ?>
                                <tr>
                                    <td colspan="6">
                                        Nenhum registro encontrado
                                    </td>
                                </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmação -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir este produto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="GET" action="index.php">
                        <input type="hidden" name="idproduct" id="deleteProductId">
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var productId = button.getAttribute('data-id');
        var modalInput = document.getElementById('deleteProductId');
        modalInput.value = productId;
    });
    </script>
</body>

</html>
