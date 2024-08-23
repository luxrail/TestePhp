<?php
session_start();
header("Content-type:text/html; charset=utf8");

require_once "../../models/categories.php";

$categories = new Categories();

if(isset($_GET['id'])){
   $list =  $categories->listCategoryById($_GET['id']);
}

$message = '';

if (isset($_POST['save'])) {
  $message = $categories->editCategory();
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
    <title>Categorias - Alterar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Visualizar Categoria
                <a href="index.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <form action="categories-edit.php?id=<?php echo $list->id;?>" method="POST">
                <div class="mb-3">
                  <label>Nome</label>
                  <input type="text" name="name" value="<?php echo $list->name; ?>" class="form-control" required>
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