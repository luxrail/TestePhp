Projeto de CRUD de Categorias e Produtos
Este projeto é uma aplicação em PHP puro que permite a criação, leitura, atualização e exclusão (CRUD) de categorias e produtos. Cada produto é vinculado a uma categoria específica. A aplicação utiliza MySQL como banco de dados.

## Funcionalidades
CRUD de Categorias:

+ Criar uma nova categoria.
+ Visualizar uma lista de categorias.
+ Editar uma categoria existente.
+ Excluir uma categoria.

CRUD de Produtos:

+ Criar um novo produto vinculado a uma categoria.
+ Visualizar uma lista de produtos.
+ Editar um produto existente.
+ Excluir um produto.
+ O projeto está organizado da seguinte forma:

## Requisitos para testar

## 1. Instalação e Configuração
+ 1.1. Pré-requisitos
+ PHP Utilizado 8.3.1
+ MySQL Utilizado 5.7.24 
+ Servidor Apache (XAMPP, WAMP, MAMP, etc.)


### 1.2. Configuração do Banco de Dados
Certifique-se de que o MySQL esteja rodando na porta 3606.</br>
Execute o arquivo .sql dentro da pasta mysql ele ja possui todas as tabelas e tambem o create database


### 1.3. Configuração do Projeto
No arquivo config.php (ou no próprio Categories.php e Products.php), ajuste as credenciais do banco de dados conforme necessário:</br>
ja esta definido como esta rodando para executar no banco

### 2. Execução
Coloque o projeto na pasta raiz do servidor Apache (por exemplo, htdocs no XAMPP).</br>
Acesse a aplicação no navegador:</br>
url http://localhost/</br>
### 3. Estrutura do Projeto</br>
Explique como os arquivos estão organizados e como cada um deles interage:</br>

Categories.php e Products.php: Arquivos principais contendo métodos para CRUD e conexão com o banco.</br>
index.php: Arquivo de entrada que exibe as categorias e produtos.</br>
mysql/: Pasta contendo o script SQL para criação do banco de dados e tabelas.
### 4. Uso
Forneça exemplos de como usar a aplicação, como adicionar uma categoria ou produto, atualizar e excluir.
