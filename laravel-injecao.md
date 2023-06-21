 ## Instalando o laravel
~~~bash 
sudo apt install composer
composer create-project laravel/laravel injecao
sudo php artisan serve
~~~
### Criando as yabelas pelos migrate
~~~bash
 php artisan migrate:rollback
~~~
Apaguei todas tabelas, depois ...
~~~bash
 sudo php artisan migrate
~~~
