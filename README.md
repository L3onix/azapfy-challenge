# Desafio técnico Azapfy para backend
## Como rodar projeto localmente
O projeto foi criado utilizando o recurso **sail** do Laravel desta forma basta seguir os
passos abaixo para executar o projeto localmente.

1. Baixar o projeto do GitHub
2. Dentro da pasta do projeto, intalar dependências com o comando: `composer install`
3. Criar arquivo **.env** com base no arquivo **.env.example**, adicionando informações de banco de dados
4. Executar o comando para subir o ambiente de desenvolvimento: `./vendor/bin/sail up`
5. Executar o comando para fazer as migrações do banco de dados (este comando também vai carregar alguns dados de teste no banco): `./vendor/bin/sail php artisan migrate --seed`
6. Executar o comando para gerar a chave de aplicação do laravel: `./vendor/bin/sail php artisan key:generate`
7. Com a aplicação rodando, o usuário pode acessar a documentação de API na url: [http://localhost/api/documentation#/]()