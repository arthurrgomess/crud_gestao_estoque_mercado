# Sistema de Gestão de Estoque - Mercado

## Objetivo

Sistema para controlar os produtos disponíveis no estoque de um mercado,
permitindo cadastrar, visualizar, editar e excluir produtos (CRUD completo),
com foco em segurança (Prepared Statements) e organização do código.

## Tecnologias utilizadas

- PHP
- MySQL
- PDO (PHP Data Objects) com Prepared Statements
- HTML

## Requisitos para execução

- PHP 8 ou superior
- MySQL / MariaDB
- Servidor local (ex: XAMPP, WAMP ou `php -S`)

## Instalação e configuração

1. Clone este repositório.
2. Execute o script `database/db.sql` no seu MySQL (via phpMyAdmin, terminal
   ou outra ferramenta) para criar o banco `gestao_estoque_mercado` e a
   tabela `produtos`.
3. Abra o arquivo `infra/conexao.php` e ajuste `host`, `usuario` e `senha`
   conforme o seu ambiente, caso necessário.
4. Coloque a pasta do projeto dentro do diretório do seu servidor local
   (ex: `htdocs`, no XAMPP).
5. Acesse `index.php` (na raiz do projeto) pelo navegador, por exemplo:
   `http://localhost/gestao-estoque-mercado/index.php`

## Estrutura do projeto

```
database/
  db.sql             -> script de criação do banco e da tabela
infra/
  conexao.php        -> conexão com o banco de dados (PDO)
public/
  funcoes.php        -> funções do CRUD (listar, buscar, cadastrar, editar, excluir, validar)
  cadastrar.php      -> formulário e lógica de cadastro (Create)
  editar.php         -> formulário e lógica de edição (Update)
  excluir.php        -> exclusão de um produto (Delete)
index.php            -> lista os produtos cadastrados (Read)
casos_de_uso.md      -> documentação de caso de uso (atores e ações)
README.md            -> este arquivo
```

## Estrutura do banco de dados

Tabela `produtos`:

| Campo               | Tipo           |
|---------------------|----------------|
| id                  | INT (PK, auto) |
| nome                | VARCHAR(100)   |
| categoria           | VARCHAR(50)    |
| descricao           | TEXT           |
| preco               | DECIMAL(10,2)  |
| quantidade_estoque  | INT            |
| data_validade       | DATE           |

## Funcionalidades principais

- **Cadastrar produto** (`public/cadastrar.php`): formulário com validação
  básica dos campos obrigatórios.
- **Listar produtos** (`index.php`): exibe todos os produtos cadastrados em
  uma tabela.
- **Editar produto** (`public/editar.php`): atualiza os dados de um produto
  já existente.
- **Excluir produto** (`public/excluir.php`): remove um produto do estoque.
- Todas as operações com o banco de dados usam **Prepared Statements**
  (em `public/funcoes.php`), evitando SQL Injection.
- Tratamento básico de erros na conexão (`infra/conexao.php`) e nas
  operações com o banco.

## Documentação de Caso de Uso

Veja o arquivo [`casos_de_uso.md`](./casos_de_uso.md) para o diagrama e a
descrição dos atores e ações do sistema.
