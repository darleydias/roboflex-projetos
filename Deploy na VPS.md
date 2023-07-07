## FAZENDO DEPLOY NO LARAVEL

IP: 194.163.44.230

Orientação : 
https://www.google.com/search?q=fazendo+deploy+com+deployer&oq=fazendo+deploy+com+deployer&aqs=chrome..69i57.8377j0j4&sourceid=chrome&ie=UTF-8#fpstate=ive&vld=cid:7cfe6ef4,vid:kx7imsZu7is

####  Instalar o deployer no desenvolvimento  : (na máquina  dev)

~~~bash
curl -LO https://deployer.org/deployer.phar
mv deployer.phar /usr/local/bin/dep
chmod +x /usr/local/bin/dep
dep init -t Laravel
~~~
Montando arquivo de configuração do deployer (na máquina  dev)
~~~bash
sudo nano deploy.php
~~~
Mudar o deploy (na máquina  dev)
~~~php
// Project name
set('application', 'acesso');

// Project repository
set('repository', 'https://github.com/darleydias/acesso.git');

.
.
.

// Hosts

host('root@194.163.44.230')
    ->set('deploy_path', '/var/www/html');    
    
.
.
.
~~~

Executar comando  deploy (na máquina  dev)
~~~bash
dep deploy
ou
dep rollback
~~~
Depois entrar no servidor:
~~~bash
ssh root@194.163.44.230 
cd /var/www/html/shared/
nano .env
~~~
Colar o conteúdo do arquivo .env do desenvolvimento  e salvar

executar o deploy de novo

~~~bash
dep deploy
~~~
Startar a aplicação 

~~~bash
var/www/html/current
php artisan serve --host 194.163.44.230
~~~
Exemplo Chamando URL da API no postman:

194.163.44.230:8000/api/local/


