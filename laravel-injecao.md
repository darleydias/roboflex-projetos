 ## Instalando o laravel
~~~bash 
sudo apt install composer
composer create-project laravel/laravel injecao
sudo php artisan serve

~~~
### Criando as tabelas pelos migrate
~~~bash
sudo php artisan make:model OrdemProducao --migration
sudo php artisan make:model User --migration
sudo php artisan make:model  Product --migration
php artisan migrate:status
php artisan migrate:rollback
~~~
Apaguei todas tabelas, depois ...
~~~bash
 sudo php artisan migrate
~~~
### Crio os fillables nos models

$fillable =['dtStart','dtEnd','codProd','numOp','quant','obs'];


### Crio os controllers
~~~bash
sudo php artisan make:controller productController
sudo php artisan make:controller OrdemProducaoController

~~~

