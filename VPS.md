### Servidor - Deploy Laravel

194.163.44.230

#### Acessando roteiro de instalação do ambiente
http://github.com/teddysun/lamp

~~~bash 
apt-get -y install wget git
git clone https://github.com/teddysun/lamp.git
  cd lamp
  chmod 755 *.sh
  ./lamp.sh
~~~
#### Configurações 

mariadb data location(default:/usr/local/mariadb/data

Apache: httpd-2.4.57
Apache Location: /usr/local/apache
Apache Additional Modules: do_not_install

Database: mariadb-10.6.14
MariaDB Location: /usr/local/mariadb
MariaDB Data Location: /usr/local/mariadb/data
MariaDB Root Password: Catelecom()123

Database Management Modules:
phpMyAdmin-5.2.1-all-languages

PHP: php-8.1.20
PHP Location: /usr/local/php
PHP Additional Extensions:
xdebug-3.1.6
~~~bash
Document root /data/www/default
~~~
#### Instalar o Laravel

Necessário ajustar no php.ini -> retirar os modulos proc_open: nano /usr/local/php/etc/php.ini:
remover:
~~~bash
disable_functions= remover -> (proc_open,proc_get_status) 
~~~
wget http://getcomposer.org/installer
php installer
php composer.phar create-project --prefer-dist laravel/laravel acesso


