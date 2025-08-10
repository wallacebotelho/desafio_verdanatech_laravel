# Desafio Verdanatech Laravel

## Projeto: Sistema de Chamados
### Descrição: Tecnologias utilizadas: Laravel 11, MySQL, Bootstrap, Vue.js, API RESTful com Sanctum.

---

## 1. Criar o projeto Laravel 11
```bash
composer create-project laravel/laravel chamados "11.*"
```

## 2. Instalar Laravel UI (rotas de autenticação + Bootstrap)
```bash
composer require laravel/ui
```

## 3. Gerar autenticação com Bootstrap
```bash
php artisan ui bootstrap --auth
```

## 4. Instalar dependências Node.js
```bash
npm install && npm run dev
```

## 5. Criar banco de dados MySQL
```sql
CREATE DATABASE desafio_verdanatech;
```

## 6. Configurar `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desafio_verdanatech
DB_USERNAME=root
DB_PASSWORD=11052017
```

## 7. Migrar tabelas
```bash
php artisan migrate
```

## 8. Criar seeder para usuário
```bash
php artisan make:seed UsuarioSeeder
```
**Obs:** Alternativa via SQL:
```sql
INSERT INTO users (name, email, password)
VALUES ("João Maria", 'joaomaria@email.com', '12345678');
```

## 9. Executar seeder
```bash
php artisan db:seed --class=UsuarioSeeder
```

## 10. Criar model, migration e controller (CRUD) para Tickets
```bash
php artisan make:model Ticket -mcr
```

## 11. Criar rota para Tickets  
## 12. Criar relacionamento `hasMany` no Model `User`  
## 13. Adicionar middleware de autenticação no `TicketController`  

---

### Migration da tabela `tickets` (Eloquent ou SQL)
```sql
CREATE TABLE tickets (
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
  CONSTRAINT `tickets_user_id_foreign`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tickets_assignee_id_foreign`
    FOREIGN KEY (`assignee_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
);
```

---

## 14. Relacionamento `belongsTo` no Model `Ticket`  
## 15. Criar factory com Faker para `tickets`  
## 16. Criar seeder `UsuarioFake` (20 registros)  
## 17. Criar seeder `Ticket` (200 registros)  

---

## 18. Criar view `index.blade.php`  
## 19. Criar atributo de status e prioridade no `TicketController`  
## 20. Passar rota (`tickets.store`), método POST e CSRF Token no form  

---

## 21. Criar view de criação de tickets  
## 22. Adicionar validação no `TicketController`  
## 23. Exibir erros de validação na view  
## 24. Criar método `assign` no `TicketController`  
## 25. Criar view `show.blade.php` para detalhes de um ticket  

---

## 26. Adicionar campo de resposta na tabela `tickets`  
```bash
php artisan make:migration add_response_to_tickets_table --table=tickets
```

## 27. Atualizar view `show.blade.php` com collapse para resposta  
## 28. Criar funcionalidade de resposta no `TicketController`  
## 29. Mover regras de validação para o Model `Ticket`  
## 30. Criar funcionalidade de atribuição de tickets no `TicketController` e na view `show.blade.php`  

---

## 31. Importar e configurar Vue.js no Laravel
```bash
composer require laravel/ui
php artisan ui vue
npm install && npm run dev
```
---

## 32. Criar Controller para API de tickets e Auth
```bash
php artisan make:controller Api/TicketController --api
php artisan make:controller Api/AuthController --api
```
## 33. Instalando a API com o Artisan
```bash
php artisan install:api
```
---

## 35. Configurar rotas de API para tickets com o Sanctum
## 36. Criado rota de login através da API e configurado no `AuthController` e no Model `User`
### Utilizar o método `createToken` do Laravel Sanctum para gerar tokens de autenticação, passar no model `User` o `HasApiTokens`

---
## 37. Adicionado o Bootstrap Icon no `layout`, para melhorar a usabilidade do usuário
