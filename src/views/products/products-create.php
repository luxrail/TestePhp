<?php
session_start();
header("Content-type:text/html; charset=utf8");
require_once "../../models/products.php";
require_once "../../models/categories.php";

$products = new Products();
$categories = new Categories();

$list_categories = $categories ->listAllCategories();

$message = '';

if (isset($_POST['save'])) {
  $message = $products->insertProduct();
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
    <title>Produtos - Adicionar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php include('../navbar.php'); ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Adicionar Produto
                <a href="index-products.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <form action="products-create.php" method="POST">
              <div class="mb-3">
                <label for="category_id">Categorias</label>
                  <select id="category_id" name="category_id" class="form-select" required>>
                  <option value="" disabled selected>Selecione uma categoria</option>
                  <?php if($list_categories) : ?>
                    <?php foreach ($list_categories as $categories) : ?>
                    <option value="<?php echo $categories->id?>"><?php echo $categories->name?></option>
                    <?php endforeach; ?>
                    <?php else : ?>
                      <option value="0">Opcao nao encontrada</option>
                    <?php endif ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label>Nome</label>
                  <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                  <button type="submit" name="save" class="btn btn-primary">Salvar</button>
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