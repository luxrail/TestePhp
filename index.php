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
<?php include('views/navbar.php')?>

<div class="container">
        <h1>Projeto de CRUD de Categorias e Produtos</h1>
        <p>Este projeto é uma aplicação em <strong>PHP puro</strong> que permite a criação, leitura, atualização e exclusão (CRUD) de categorias e produtos. Cada produto é vinculado a uma categoria específica. A aplicação utiliza <strong>MySQL</strong> como banco de dados.</p>

        <h2>Funcionalidades</h2>

        <h3>CRUD de Categorias:</h3>
        <ul>
            <li>Criar uma nova categoria.</li>
            <li>Visualizar uma lista de categorias.</li>
            <li>Editar uma categoria existente.</li>
            <li>Excluir uma categoria.</li>
        </ul>

        <h3>CRUD de Produtos:</h3>
        <ul>
            <li>Criar um novo produto vinculado a uma categoria.</li>
            <li>Visualizar uma lista de produtos.</li>
            <li>Editar um produto existente.</li>
            <li>Excluir um produto.</li>
        </ul>
</div>
</body>
</html>