<?php
session_start();
header("Content-type:text/html; charset=utf8");

require_once "../../models/categories.php";

$categories = new Categories();

$list_categories = $categories->listAllCategories();

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);

if (isset($_GET["idcategory"])) {
    $message = $categories->deleteCategory($_GET["idcategory"]);
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
    <title>Categorias</title>
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
                        <h4>Lista de Categorias
                            <a href="categories-create.php" class="btn btn-primary float-end">Nova
                                Categoria</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Data Cricao</th>
                                    <th scope="col">Data Atualizacao</th>
                                    <th scope="col">Acoes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($list_categories) : ?>
                                <?php foreach ($list_categories as $categories) : ?>
                                <tr>
                                    <td><?php echo $categories->id; ?></td>
                                    <td><?php echo $categories->name; ?></td>
                                    <td><?php echo $categories->created; ?></td>
                                    <td><?php echo $categories->updated; ?></td>
                                    <td>
                                        <a href="categories-edit.php?id=<?php echo $categories->id; ?>"
                                            class="btn btn-success">Alterar</a>
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                            data-id="<?php echo $categories->id; ?>">Excluir</button>
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
                        <input type="hidden" name="idcategory" id="deleteCategoryId">
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
        var modalInput = document.getElementById('deleteCategoryId');
        modalInput.value = productId;
    });
    </script>
</body>

</html>
