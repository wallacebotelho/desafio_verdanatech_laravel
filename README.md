# desafio_verdanatech_laravel

1º Primeiro passo criar um projeto Laravel 11 utilizando o composer
composer create-project laravel/laravel chamados "11.*"

2º Instalar o pacote Laravel UI, para as rotas de autenticação + frontend com o Bootstrap
composer require laravel/ui

3º Gerar autenticação com o bootstrap utilizando o Artisan
php artisan ui bootstrap --auth

4º Instalar as dependências com Node.js utilizando o npm
npm install && npm run dev

5º Criar o banco de dados no MYSQL Workbench
CREATE DATABASE chamados;

6º Editar o arquivo .env para configuração do banco de dados MYSQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chamados
DB_USERNAME=root
DB_PASSWORD=11052017

6º Migrar tabelas com o Artisan
php artisan migrate

7º Criar Seed para criação de usuário
php artisan make:seed UsuarioSeeder
OBs: Caso utiliza-se o comando SQL para criação do usuário
(INSERT INTO users (name, email, password) VALUES ("Wallace Botelho", 'wallacebotelho@msn.com', '12345678'))

8º Executando a seeder
php artisan db:seed --class=UsuarioSeeder

9º Criar migration, controller com CRUD, utilizando o Artisan
php artisan make:model Ticket -mcr

10º Criado rota para os Tickets

11º Criado o relacionamento com o Eloquent de tickets com HasMany no model User

12º Passado o middleware de autenticação para o controller TicketController, para todas as rotas somente serem acessadas se o usuário estiver autenticado.

13º Criado a migration para criação da tabela tickets
Obs: Caso a criação fosse feita em comando SQL
(CREATE TABLE tickets (
id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
description TEXT,
status VARCHAR(255) NOT NULL DEFAULT 'aberto',
priority VARCHAR(255) NOT NULL,
user_id BIGINT UNSIGNED NOT NULL,
assignee_id BIGINT UNSIGNED NULL,
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,

-- Chaves Estrangeiras
CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
CONSTRAINT `tickets_assignee_id_foreign` FOREIGN KEY (`assignee_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
);)

14º Criado relacionamento belongsTo no Model Ticket para usuário e responsável

15º Criado factory com a biblioteca facker para criar dados aleatórios na tabela tickets

16º Criado a seeder UsuarioFake para popular o banco com o factory com 20 linhas

16º Criado a seeder ticket para popular o banco com o factory com 200 linhas







