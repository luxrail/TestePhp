<?php
session_start();
header("Content-type:text/html; charset=utf8");

require_once "src/Models/categories.php";

$categories = new Categories();

$list_categories = $categories->listAllCategories();

$message = '';

if (isset($_GET["idcategory"])) {
    $message = $categories->deleteCategory($_GET["idcategory"]);
    $_SESSION['message'] = $message;
    header('Location: index-products.php');
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
    <?php include('src/views/navbar.php')?>
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
                            <a href="src/views/categories-create.php" class="btn btn-primary float-end">Nova
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
                                        <a href="src/views/categories-edit.php?id=<?php echo $categories->id; ?>"
                                            class="btn btn-success">Alterar</a>
                                        <a href="index.php?idcategory=<?php echo $categories->id; ?>"
                                            class="btn btn-danger">Excluir</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
