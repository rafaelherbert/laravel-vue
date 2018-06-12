# laravel-vue
### Um gerenciador de tarefas feito com laravel e vue.js | A Task manager made with laravel and vue.js.

![alt text](https://github.com/rafaelherbert/laravel-vue/blob/master/Captura%20de%20Tela%20(334).png)

Cada uma das requisições do Gerenciador de tarefas é feita com a Ajax.
Each one of the requests on the Task Manages ir made with Ajax.

To use the project, follow the next steps:
 
- Clone your project
- Go to the folder application using cd command on your cmd or terminal
- Run composer install on your cmd or terminal
- Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password  (DB_PASSWORD) field correspond to your configuration.
- By default, the username is root and you can leave the password field empty. (This is for Xampp)
- By default, the username is root and password is also root. (This is for Lamp)
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan serve

Para utilizar o projeto, siga os seguintes passos:

- Clone seu projeto
- Vá para o aplicativo de pasta usando o comando cd no seu cmd ou terminal
- Execute a instalação do compositor no seu cmd ou terminal
- Copie o arquivo .env.example para .env na pasta raiz. Você pode digitar copy .env.example .env se estiver usando o prompt de comando Windows ou cp .env.example .env se estiver usando terminal, Ubuntu
- Abra seu arquivo .env e altere o nome do banco de dados (DB_DATABASE) para o campo que você tenha, username (DB_USERNAME) e password (DB_PASSWORD) correspondente à sua configuração.
- Por padrão, o nome de usuário é root e você pode deixar o campo de senha vazio. (Isso é para o Xampp)
- Por padrão, o nome de usuário é root e a senha também é root. (Isto é para a lâmpada)
- Executar php artisan key: gerar
- Executar o php artisan migrate
- Executar o serviço de artesão php
