
##############################################
# SERVIDOR DE BANCO DE DADOS - ROBOFLEX 
##############################################

## INSTALANDO BANCO

sudo apt install mariadb-server
sudo mysql_secure_installation

## CRIANDO USUARIO

sudo mysql
grant all privileges on . to 'roboflex'@'%' identified by 'Roboflex()123';
flush privileges;
exit

## CONFIGURANDO ACESSO REMOTO 

sudo nano /etc/mysql/mariadb.conf.d/50-server.cnf

Bind-address 0.0.0.0

Salve

Reinicia o banco

sudo systemctl restart mariadb

Comando para parar mariadb, dentro do conteiner docker: sudo /etc/init.d/mariadb stop

## ERRO NO DOCKER

Docker estava dando um pau horrivel, sempre retornava: docker: Error response from daemon: Get "https://registry-1.docker.io/v2/": dial tcp: lookup registry-1.docker.io: Temporary failure in name resolution.
See 'docker run --help'

### Solução:

Editei : sudo nano /etc/resolv.conf
acrescentei nameserver 8.8.8.8
sudo systemctl daemon-reload
sudo systemctl restart docker
Dentro do term do container do mysql

apt-get update && apt-get -y install sudo 
apt-get update && apt-get install -y build-essential 
curl git libfreetype6-dev libpng12-dev libzmq3-dev pkg-config python-dev python-numpy python-pip software-properties-common swig zip zlib1g-d
apt-get install nano
sudo nano /etc/mysql/mariadb.conf.d/50-server.cnf
      
     Bind-address 0.0.0.0

Para entrar em um conteriner e atuar no terminal:

sudo docker exec -t -i dbProd bash

##############################################
## ACEESSO SERVIDOR ROBOFLEX
##############################################
ssh catena@192.168.0.112
senha Cate
sudo su
senha Cat


##############################################
# SERVIDOR  DE APLICACAO - ROBOFLEX 
##############################################

## Instalaçao DOCKER

### sudo apt-get update
### sudo apt-get curl
### sudo apt-get update
### sudo apt-get install ca-certificates curl gnupg lsb-release
### curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
### sudo apt-get update
### sudo apt-get install docker-ce docker-ce-cli containerd.io
### sudo usermod -aG docker $USER

## Comandos 

docker run --name sgiApl -p 80:80 -d  wyveo/nginx-php-fpm:php81
sudo docker exec -it sgiApl bash
docker stop sgiApl
docker start sgiApl
### Document root
/usr/share/nginx/html


##############################################
# COMANDOS GUIT
##############################################

### git add index.html package.json package-lock.json README.md webpack.config.js src/
git status
sudo git commit -m "versaoBeta-1"
sudo git remote -v
sudo git branch -M main
sudo git branch -M main
sudo git remote add origin https://github.com/darleydias/cadeia.git
sudo git push -u origin main

##############################################
# DOCKER
##############################################

## ---------------
## Extensões do VSCode para docker:
## Docker e Docker Explorer
## Instalaçao DOCKER

### sudo apt-get update
### sudo apt-get curl
### sudo apt-get update
### sudo apt-get install ca-certificates curl gnupg lsb-release
### curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
### sudo apt-get update
### sudo apt-get install docker-ce docker-ce-cli containerd.io
### sudo usermod -aG docker $USER
### sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

### sudo chmod +x /usr/local/bin/docker-compose
### https://hub.docker.com/
### docker --help


### Comandos

### baixa e executa uma imagem

#### docker run nome-imagem


### mostra todas imagens baixadas na máquina
#### docker images

### mostra as imagens que estão rodando
####  docker ps

### expoe algum servico
#### docker ps -a

### mostra imagens presentes independente de estar expondo serviços
#### docker run -it ubuntu ls
#### exemplo : docker run --name mynginx1 -p 80:80 -d nginx


### baixa e poe pra rodar uma imagem interativa(-i) modo tty (t) dá uma ls no raiz do ubuntu
#### docker run -it ubuntu bash

### roda um terminal

### sai do container
#### exit

#### docker run -itd ubuntu

### Subindo um container expondo uma porta:
#### docker run -d -p 80:80 apache
### nesse caso o primeiro 80 é da minha máquina local que estará escutando a porta 80 do container
#### docker run -d -p 81:80 apache
### posso colocar outra porta da minhamaquina local escutando uma porta do container
### Posso dar um nome ao meu container:
#### docker run -d --name servidor77 -p 81:80 apache
### funciona igual ao id
### Posso passar variaveis de ambientes para o container:
#### docker run  -d -e MYSQL_ROOT_PASSWORD=123456 --name mysql-cadeia -p 3306:3306 mysql:5.7.22
#### docker exec -it  mysl-cadeia mysql -u root -p
### Posso criar uma cópia de alguma paste de um contaier na minha máquina local como backup. Se apagar o container o dado estará em nossa máquina
### podendo ser restaurado
### Ex:
### docker run --name bancoDeDados -e --volume = ~/ .data/mysql :/var/lib/mysql MYSQL_ROOT_PASSWORD=123456 -d -p 3306:3306 mysql:5.7.22
### ~/ .data/mysql - > Pasta que criei dentro da minhya máquina para hospedar o backup
### /var/lib/mysql  pasta que está dentro do container contendo os dados do mysql
### para descobrir esta pasta dou o comando : docker inspect bancoDeDados
### acho uma variavel chamada volume
### a primeira vez que rodo isso ele sob a máquina e copia parta a pasta local o backup dos dados.
### se apagar, basta repetir o mesmo comando e ele recomporá o banco
### Pode subir a máquina limitando uso de memória, processamento
### memória passo o parametro -m 1024M valor em megabytes
### sempre dou um stop antes
### para saber quanto está rodando de recursos faco:
### docker stats t7t56ttu87ht7
### pra ver as maquinas docker ps
### Parametro para cpu --0.2 (20%)
### docker run -itd -m 1024M --cpus 0.2 ubuntu
### fazendo um teste de estress :
### apt-get stress
### stress --cpu 8 --io 4 --vm 2 --vm-bytes 128M --timeout 30s
### Atualizandoos parametros de estress do container sem contudo parar o container
### docker update g76t6yt78y7yh -m 512M --cpu 0.3
### para testar:  docker stats  g76t6yt78y7yh
### buscando informações do docker em si :
### docker info
### Ver logs dentro de um container:
### docker logs g76t6yt78y7yh
### docker logs g76t6yt78y7yh -f (mostra em tempo real)
### Ver todos processos de um container sem entrar nele:
### docker top g76t6yt78y7yh

######################################################################


FLUTTER
#######################################################

### Ao rodar ‘flutter doctor’ Estava dando erro 

Faltava instalar no sdkmanager:

###Outro defeito: falava que não tinha licença:

flutter doctor  --android-license

###Criando Projeto:

 flutter create catena
 cd catena
 code . 
 flutter run
 
Extensão code runner

ctrl+alt+N ou M

## binário que verifica nulidade dentro do jsx:
---------------------------------------

    { (props.title || "--Atributo tilte não informado--") }
    se for chamado componente sem informar a propriedade, tipo:   <Component/> quando deveria ser : <Component1 id="componente1" title="Aula de Marketing" subtitle="Vendendo mais"/> retornará a msg de erro
    import React,{useState} from 'react'; 
    import logo from './logo.svg';
    //import './App.css';
    import Main from './Main'
    import Header from './Header';

function App() {
  const [user,setUser] = useState('Valdir');
  const [password,setPass] = useState('yhvh77');
  const onClick = ()=>{
    alert(user);
    setPass(22);
    setUser('Carlos');
  }
  const nameContext = React.createContext('name')
  return (
    <div className="App">
      <Header/>
      <Main user={user} pass={password}/>
       {user}
      <button type='button' onClick={onClick}>Mostra</button>
    </div>
  );
}
 ## Configuração python
##################################

    ### https://www.anaconda.com/
    ### GetStart
    ### https://www.anaconda.com/products/individual#Downloads
    ### cd /Dowbloads
    ### cp AnacondaxxxLinux.sh /home/darley
    ### chmod +x AnacondaxxxLinux.sh
    ### ./AnacondaxxxLinux.sh
    ### <enter>
    ### yes
    ### echo "export PATH=$PATH:/home/darley/anaconda3/bin">> ~/.bashrc
    ### source ~/.bashrc
    ### conda list
    ### anaconda-navigator
    ### jupyter lab
    ### Recebi o processo acima as 10:10 e passei para o Nairo
    ### ######################################################
    ### Desenvolvimento anaconda
    ### Download scrap do curso alura "Scraping com Python: Coleta de dados na web"
    ### abra o VS Code e abra a pasta web-scraping
    ### abra o terminal
    ### dois cliques no arquivo "Web scraping.ipynb"
    ### levantando o jupyter
    ### jupyter lab

## TREINAMENTO  DJANGO
### ____________________
### Criando o ambiente
### criar uma pasta para o app
### mkdir coeciber
### cd coeciber
### subindo a venv
### sudo apt-get install python3-venv
### python3 -m venv ./venv
### source /home/darley/coeciber/venv/bin/activate
### subiu
### pip install django
### para mostrar todos os módulos instalados em um venv:
### pip freeze
### help do django:
### django-admin help
### Iniciando um projeto:
### django-admin startproject processos .
### tive que mover a pasta processos uma nivela acima
### python manage.py help
### por algum motivo estva dando pau, ai vi que o ambiente não estava ativado
### então fiz:
### source /home/darley/coeciber/venv/bin/activate
### depois:
### python manage.py migrate
### para corrigir um erro
### python manage.py help
### python manage.py runserver
### subi o servidor
### +++++++++++++
### Username.com
### Textbin
### ++++++++++++++
### Configurando venv no vscode
### <ctrl><shift><p>
### python select interpreter
### selecione a opção venv
### Criando um app:
### entre no terminal (certifique que está no venv)
### pesquise:
### python manage.py help
### registrando app
### dentro do appProcessos, entre em apps.py leia names, no caso foi: appProcessos
### entre em processos (que é a pasta de configurações) e abra settings.py
### em INSTALLED APPS insita "appProcessos":

### Acessando o APP:
### dentro de appProcessos, crio um arquivo chamado urls.py
### Dentro dele:
### from django.urls import path
from . import views
### Criando a rota:
### urlpatterns=[
    path('',views.index,name='index')
]
### como apontei o root para uma view index tenho que criar no arquivo de view
### arquivi view.py no app
### Crio a funcao abaixo registrando a view
def index(request):
    return HttpResponse('<h1>Processos</h1>')
### Agora registro as rotas na pasta de congiguracao (processos), abrindo urls.py
### FICOU ASSIM:


### CRIANDO TEMPLATES
### #######################################
### Crie  pasta templates, dentro do app


### CRIA DENTRO DELA O index.html
### Chamando o template:
### no arquivo views.py no app appProcessos faça:


### Trabalhando com arquivos estatico(css, etc)
### Entrar no arquivo settings.py dentro da pasta de configuracao "processos"
### adicionar na seção de templates
### a chave 'DIRS'


Criar a pasta "static" dentro de "appProcess

configurar a seção STATIC AS TRÊS LINHAS STATIC_ROOT,STATIC_URL E STATICFILES_DIRS


### informar ao django como referenciar os arquivos estáticos
### na linha de comando no ambiente venv digitar : python manage.py help
### na sessão [staticfiles] está o comando collectstatic:
### python manage.py collectstatic
### para reconhecer as pastas staticas é preciso também informar nos arquivos estaticos, assim:
### no index,html dentro do template:
### Coloco em todos os links {% antes  e %} depois, coloco o link entre aspas simples e a palavra static antes:
### {% static 'img/core-img/favicon.ico' %}
### fazer o mesmo com imagens


### Ativando Links na página
### ####################################################
### Preciso mudar os links xxxx.html, para uma chamada python do nome de página descrito no arquivo de rotas urls.py
### No caso de link para novas páginas tenho que criar a url no arquivo de rota para anova página
### Por exemplo a alinha:]


	Mudo para:


	 arquivo urls.py é modificado acrescentando uma rota

### Portanto tenho que criar essa view
### dentro do arquivo view.py


Depois de informar a view de processo no arq hiwl, tenho que criar a view processo.htlml na pasta template

### Criando codigo basr que vai se repedit em tods html
### Crio dentro de template um arquivo chamado base.html
### Copio o começo do arquivo index, que se repeditá em todos para o base.html

### recorta do arquivo index.html o trecho final depois do footewr
### INserindo o arquivo index ncomo bloco de meiono auquivo base
### Vou no index.html e infoprmo que ele é um bloco e no base informo onde entra este bloco
### portando no index faco:
### como inserir bloco dentreo do base
### {% block content%} {% endblock%}
### Na index informo qual trexo de codigo é o bloco, extendo o arquivo para o base a adiciono a diretiva de que ele carrega conteuco estatico
### Assom dentro de index.html coloco:
### {% extends 'base.html'%}
### {% block 'content'%}

### No fim do arquivo colcocoo fim do bloco
### {% endblock%}

Corrigindo

### faço o mesmo co o arquio processo.html
### dentro do arquivo processo corrigir os src das imagens colocando o {% nstatic 'img...
### Mudar tambel os links
### href="{% url 'index'%}"


### Para melhorar a pagina, nas paginas html criei um arquivo de footer.html um de menu.html e levei o contgeudo deles par esses arquivos que foram colocados em uma poasta chamada partials
### briei tambem um arquivo basehtls e ele chama o index no moi deizando em sima e em baixo o css e js
### portanto tireio o codigo de menu dos dois processo e index e leveiparao menu.htm
### no aruivo de onde tiro o códico coloco im imclude:
### importante levar para os raquivoa novos de menu e footer a diretiva pra considerar aquivos stattic


### ##############################################
### A página de view "chama um html" podemos chama esse html pela view passando um aparametro para aparecer no html


Na view acrescento um parametro


### erando foi criado um dicionário na viewl com as informasçoes a serem iteradas
### ################################################
### Criando banco de dados
### #######################################
### https://www.postgresql.org/download/linux/debian/
### psql -c "ALTER USER coeciber WITH PASSWORD 'yhvh77'" -d template1
### su postgres
### ai entrei no terminal postgres
### /home/darley$ psql -c "ALTER USER postgres WITH PASSWORD 'yhvh77'" -d template1
### ai abri o cliente e criei uma conexao com usuario postgres e senha yhvh77
### criei na GUI um servidr que dei o nom  de dbServer usuario postgres senha yhvh77
### intslando o driver do banco na plaicação
### no terminal, dentro da venv,
### pip install psycopg2
### pip install psycopg2-binary
### Agora posso confogurar o arquivo de banco
### Criando uma entidade no bancoi
### fui9 na pasta do app e criei uma classe que chamei de processo da 

seguinte forma:

### e para criar um atabela atravez disso?
### entr num terminal
### no terminal python manager. py makemigrations (claro que é no env)
### deu um pau
### ai fiz:
### sudo apt install libpq-dev python3-dev
### criei na GUI um servidr que dei o nom  de dbServer usuario postgres senha yhvh77
### depois fiz sudo apt install libpq-dev python3-dev
### o arquivo ficou assim

olha o que o migratiosn criou

### Pssando efetivamente parta o banco:
### python manage.py migrate
### ############################################
### REcurso admin para rira cruds
### Denro do app tem um apasta admin
### pasta nao, um admin.py
### Importo a classe model

Já existe uma aplicaçõa admin por padrao se eu digitar hhtp://127.0.0.1:8080/admin ja abre uma tela de logim só que não está pronto. mas tem a rota criada em urls.py

### vamos ver como fazer no help
### python manage,py help
### python manage.py createsuperuser
### usuario:coeciber
### senha yhvh77
### ###############################################################
### Buscando o dado do banco
### mudo o for na pagina index.html

Na view importei a classe de modelo

E mudei as funções que retornavam os dados de um dicionário para classe de modelo do banco

### Instalando driver para mysql no django
### pip install mysqlclient

### ########################################################

### cd Coeciber/robo
### Source bin/activateComandos criação django

   source processo/bin/activate
   deactivate
   virtualenv processo -p python3
   source processo/bin/activate
   pip install "Django==3.0.*"
   /home/darley/processo/bin/python -m pip install --upgrade pip
   django-admin startproject processosConf
   cd processosConf/
   mv processosConf/* .
   pip install psycopg2
   pip install psycopg2-binary
   sudo apt install libpq-dev
   sudo apt install python3-dev
   pip3 install mysql-python
   sudo pip3 install mysql-python
   pip install MySQL-python
   pip install PyMySQL
   source bin/activate
   python manage.py startapp process
   python manage.py makemigrations
   python manage.py migrate

### python manage.py startapp appProcessos
### https://images.app.goo.gl/vnFMAF6Ya9igGLh47
### python3 manage.py runserver 194.163.44.230:8000

### rom bs4 import BeautifulSoup as bs 
from urllib.request import urlopen
import requests
from lxml import html

session_requests = requests.session()
login_url = "https://seisip.mpmg.mp.br/sip/login.php?sigla_orgao_sistema=MPMG&sigla_sistema=SEI"
result = session_requests.get(login_url)
tree = html.fromstring(result.text)
authenticity_token = list(set(tree.xpath("//input[@name='hdnToken9d70d38813e289d87aeb05d8799d15d5']/@value")))[0]
#result.cookies.get('PHPSESSID')
print(authenticity_token)

payload = {
    "txtUsuario":"dwdias.pmmg",
    "pwdSenha":"Catelecom123",
    "hdnToken9d70d38813e289d87aeb05d8799d15d5":authenticity_token
}

result = session_requests.post(
	login_url, 
	data = payload, 
	headers = dict(referer=login_url)
)
print(result.ok)
print(result.status_code) 
url="https://seisip.mpmg.mp.br/sip/login.php?sigla_orgao_sistema=MPMG&sigla_sistema=SEI"
result = session_requests.get(
	url, 
	headers = dict(referer = url)
)
print(result.ok)
print(result.status_code)  
tree = html.fromstring(result.content)
print(tree.xpath("//*[@id='main-menu']"))
### sudo dd if=/home/darley/Downloads/tails-amd64-4.25 (2).img of=/dev/sdb1
   cd ~/Downloads/tails-amd64-4.25
   cd ~/Downloads/
   sudo mv tails-amd64-4.25 (2).img tails-amd64.img
   sudo mv 'tails-amd64-4.25 (2).img' tails-amd64.img
 * ls tails-amd64-4.25.img 
   sudo dd if=/home/darley/Downloads/tails-amd64-4.25.img of=/dev/sdb1
   history
### Deu um monte de pau ao levantar o servidor python manage.py runserver, perguntando se tinha instalado o mysqlclient
### ai usei o cmd:
### pip3 install mysqlclient
### Terminal tkstar Guim
### INSTALAÇÃO MYSQL DEBIAN 11
--------------------------
sudo apt update
wget http://repo.mysql.com/mysql-apt-config_0.8.13-1_all.deb -O mysql-apt-confi>
sudo dpkg -i mysql-apt-config.deb
sudo dpkg-reconfigure mysql-apt-config
sudo apt update
sudo apt install mysql-server
### INSTALANDO phpMyAdmin NO DEBIAN 11
--------------------------
wget https://files.phpmyadmin.net/phpMyAdmin/4.9.7/phpMyAdmin-4.9.7-all-languages.tar.gz
tar xvf phpMyAdmin-4.9.7-all-languages.tar.gz
sudo mv phpMyAdmin-4.9.7-all-languages/ /usr/share/phpmyadmin
sudo mkdir -p /var/lib/phpmyadmin/tmp
sudo cp /usr/share/phpmyadmin/config.sample.inc.php /usr/share/phpmyadmin/config.inc.php
sudo nano /usr/share/phpmyadmin/config.inc.php
descomente as linhas
$cfg['Servers'][$i]['controluser'] = 'pma';
$cfg['Servers'][$i]['controlpass'] = 'password';
descomente a seção 
/* Storage database and tables */
$cfg['Servers'][$i]['pmadb'] = 'phpmyadmin';
$cfg['Servers'][$i]['bookmarktable'] = 'pma__bookmark';
$cfg['Servers'][$i]['relation'] = 'pma__relation';
$cfg['Servers']…
### Roteirinho projeto django
### ------------------------------------------------
### Sobe ambiente: source venv/bin/activate
### Cria Projeto
### django-admin startproject
### Cria app
### django-admin startapp
### python3 -m venv ./venv
### Instalando python : sudo apt-get install python3
### sudo apt-get install python3-pip
### python3 --version
### python3 -m venv ./venv
### source venv/bin/activate
  pip install django
  pip freeze
### criando a pasta de configuração
### django-admin startproject config .
### python manage.py migrate
### mudando arquivo settings
### LANGUAGE_CODE = 'pt-br'

TIME_ZONE = 'America/Sao_Paulo'
### python manage.py startapp investigacao
### mudei configuracao /settings.py
### Mudei Investigação views.py
### regidstrei o app
### Criei template dentro de investigação
### dentro coloquei o index.hyml
### mudei a configuracao para arquivos estaticos
### no settings
### no settings.py da configuracao importei a biblioteca os
### python3 --version
### acrescentei no mesmo arquivo
### crescentei as referencias de static
### copiar para dentro de static da pasta configuracao os arquivos
### deu um erro
### django.core.management.base.SystemCheckError: SystemCheckError: System check identified some issues:

ERRORS:
?: (staticfiles.E001) The STATICFILES_DIRS setting is not a tuple or list.
        HINT: Perhaps you forgot a trailing comma?
### porque no arquivo configuração/setings.py estava errado
### Quando deveria estar:
### tava continuanado a aparecer o foguetinho
### tinha faltado criar em investigacao o arquivo de urls.py
### com o conteudo
### from django.urls import path
from . import views

urlpatterns =[
    path('',views.index,name='index')
]
### tinha faltado também colocar no urls.py da pasta configuracao
### que vem assim:
### from django.contrib import admin
from django.urls import path

urlpatterns = [
    
    path('admin/', admin.site.urls),
]
### Retrovisor
### Canaletas esborrachas
### esse comando não funciona sem: sudo apt-get install python3-venv
### Fica assim:
### from django.contrib import admin
from django.urls import path,include

urlpatterns = [
    path('',include('investigacao.urls')),
    path('admin/', admin.site.urls)
]
### depois python manage.py collectstatic
### Tava tudo doidao, faltava o arquivo site.css na pasta static
### Kpo
### Eu não estava conseguindo aplicar no html a diretiva static, tinha esquecido de colocar no inicio do arquivo {% load static %}
### Servidor: 194.163.44.230
### usuario root
### senha: Nareserva()123
### Solução de um merro ao fazer uddate
### dava um erro na xhave pública do repositório
### fiz:
### apt-key adv --keyserver keyserver.ubuntu.com --recv-keys um monte de letra que apareceu
### ipo sudo apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 76F1A20FF987672F
### dai rodou


### CRIANDO PROJETO VUE
### -------------------------------------------------
### sudo mkdir cadeiaCustodiaVue
cd cadeiaCustodiaVue/
python3 -m venv ./venv
sudo python3 -m venv ./venv
source /home/darley/nomenos/cadeiaCustodiaVue/venv/bin/activate
apt install npm
sudo apt install npm
sudo npm install vue-cli@2.7.0 -g
### vue --version
### vue init webpack-simple cadeiaCustodia
sudo vue init webpack-simple cadeiaCustodia
cd cadeiaCustodia/
sudo npm install
npm run dev
### para que o vue consiga ler uma api instalar na mesma pasta onde está parta de API e também do cliente VUE
### sudo npm install vue-resource@1.0.3 --save
### registrando o pacote vue-resource@1.0.3
### tenho que registrar no arquivo main.js
### Fica assim:
### import Vue from 'vue'
import App from './App.vue'
import VueResource from 'vue-resource';

Vue.use(VueResource)

new Vue({
  el: '#app',
  render: h => h(App)
})
### adicionou-se:
### import VueResource from 'vue-resource';

Vue.use(VueResource)
### usando bootsrap
### Na pasta do projeto
### npm install bootstrap-vue bootstrap
### REgistrando mo main.js
### Adicionei
### import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
### O arquivo ficouo assim:
### import Vue from 'vue'
import App from './App.vue'
import VueResource from 'vue-resource';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(VueResource)
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

new Vue({
  el: '#app',
  render: h => h(App)
})
### o App.vue por enquanto está asssim
### <template>
<div>
  <b-div class="alert alert-primary" role="alert">
    Um simples alerta primary. Olha só!
  </b-div>
  <b-container class="table" style="margin-top: 20px;margin-left: 40px">
  <ul>
    <li :align="alinhamento">Nr Processo</li>
    <li>Data de Início</li>
    <li>Natureza</li>
  </ul>
  <ul>
    <li v-for="cadeia of cadeias">
      {{ cadeia.nrPro }} - {{ cadeia.dtInicio}} - {{ cadeia.natureza }}
    </li>
  </ul>
  </b-container>
</div>
</template>

<script>
export default {
  data () {
    return {
      titulo: 'Controle da Cadeia de Custódia',
      //mudar para cadeias[];
      cadeias:[
      {
        nrPro:'87687887-2021',
        dtInicio:'12/03/2022',
        natureza:'Ameaça'
      },
      {
        nrPro:'3547688657-2021'
###  dtInicio:'25/03/2022',
        natureza:'Pedofilia'
      },
      {
        nrPro:'23546234534-2021',
        dtInicio:'31/12/2022',
        natureza:'Estelionato'
      }
      ],
      alinhamento:'left'
    }
  },
  created(){
    this.$http.get('http://localhost:3000')
      .then(res=>res.json())
      .then(cadeias=>this.cadeias=cadeias);
  }
}
</script>

<style>



</style>
### Hospedagem 194.163.44.230
### sirh senha drm098
### Criando componentes
### criar em src pasta components
### https://github.com/thiagosoares-mppi/simq
### Ao Criar um componente:

1)Crio dentro de share - Primera letra maiuscula
/home/darley/nomenos/cadeiaCustodiaVue/cadeiaCustodia/src/components/shared/

2) Fazento o coponente ser reconhecido no App.vue
2.1 No App.vue coloco em <template> a tag do componente : <meu-componete> 
2.2 Para que essa tag seja acessada, no export crio a importaçao:
2.2.1 import Painel from './components/shared/painel/Painel.vue'
2.2.2 declaro o componente: components:{'meu-componente':Painel}

3) para passar dados do componente pai para o filho:
3.1 Crio uma propriedade que queira passar para o filho na minha tag do component, no App.vue:
<painel-desktop :nrPro="cadeia.nrPro">
3.1 No component filho, tenho que setar em exports quais propriedades esse component aceita receber, isso estará na propriedade props
export default{
    props:['nrPro']
}
para que o conteudo da tag filho criada no pai, vá para dentro do componente filho, no filho defino uma tag slot. O que tiver dentro da tag <painel-conteudo> 

Pode-se criar vários slots, apenas os nomeando:


<!-- ComponenteQualquer.vue -->
<template>
    <div>
        <slot name="cabecalho" class="header" ></slot>
        <hr>
        <slot class="body"></slot>
        <hr>
        <slot name="rodape" class="footer"></slot>
    </div>
</template>

Ai no componente que chama:

<componente-qualquer>
    <div slot="cabecalho">
        <h1>Bem-vindo!</h1>
    </div>
    <p>Seja bem-vindo à Alura!</p>
    <div slot="rodape">
        <p>copyright 2017</p>
    </div>
</componente-qualquer>

 
se eu quizer que um estilo fique só no componente, basta na tag <style> colocar scoped, ou seja <style scoped>

Pegando dados de um input:

1) na seção data coloco uma variével (filtro);
2) no campo input coloco: v-on:input="filtro=$event.target.value" estou colocando no valor da variavel o valor do campo a cada input
3) se colocar na tela {{filtro}}, aparecerá o valor a cada digitação
4) Tenho que fazer uma computação para saber o que exibir na tela depois do filtro (computed). Essa é mais uma diretiva dentro de <script>

depois de data, coloco
	dadosComFiltro(){
		if(this.filtro){
		  let exp = new RegExp(this.filtro.trim(),'i') i 'i' é para ignorar case sensitive		   
		  return this.cadeia.filter(cadeia=>exp.test(cadeia.nrPro));
		}else{
		  return this.cadeia;
		}
	}  isso vai funcionar como uma propriedade usado no campo input


### TRABALHANDO COM ROTAS
---------------------

npm install vue-router@2.1.1 -save

mudar o arquivo main.js 
	import VueRouter from 'vue-router'
	registrando:
	Vue.use(VueRouter)
Dentro do src criar o arquivo routes.js
import Cadastro from './components/cadastro/Cadastro.vue';
import Home from './components/home/Home.vue';
export const routes=[
    {path:'',component:Home},
    {path:'/cadastro',component:Cadastro}
];
 Depois registro no main:

com o auxilio do vueRouter, passando as informações das rotas

import {routes} from ',/routes';
Vue.use(VueRouter);
const router = new VueRouter({
  routes:routes
});
### Botão de exclusão
### CRIAR UM BOTÃO
---------------
Criar uma pasta dentro de components/share chamada botão
Criar um arquivo Botao.vue dentro da pasta
### DENTRO DO ARQUIVO BOTÃO
----------------------
<template>
	<button class="botao botao-perigo" :type="tipo">{{rotulo}}</button>
</template>
### <script>
export default {
props:['tipo','rotulo']
}
</script>
### NO ARQUIVO home.vue
### Acrescento a quarta linha:
### <div v-for="cadeia of dadosComFiltro">
          <painel-desktop :nrPro="cadeia.nrPro">
            {{ cadeia.nrPro }} - {{ cadeia.dtInicio}} - {{ cadeia.natureza }}
            <meu-botao tipo="button" rotulo="x"/>
          </painel-desktop>
      </div>
### Dentro do Script :  import Botao from '../shared/botao/Botao.vue';
### Acrescento em components:
### components:{
    'painel-desktop':Painel,
    'meu-botao':Botao
  },
### CRIANDO METODO
--------------

1) No arquivo chamador (home.vue) Acrescento uma seção Methods
methods:{
	remove(cadeia){
		if(confirm("Confirma a operação?")){
		  alert("Remover linha"+cadeia.nrPro);
		}
        }
  },
2) Acrescento a propriedade @click.native="remove()"
 <meu-botao tipo="button" rotulo="x" @click.native="remove(cadeia)"/>
### PASSANDO DADOS DO FILHO PARA O PAI
-----------------------------------
props passa informação do pai para o filho.

1) No elemento pai (home), chamo o filho COMPONENTE (BOTÃO)
<meu-botao tipo="button" rotulo="x" @botaoAtivado="remove(cadeia)"/>

o @botaoAtivado se comporta como um evento, sera acionando pelo componente filho, que é um botao, se hoouver confirmação.
2) Dentro do filho (COMPONENTE BOTAO) crio um evento clique no button, chamando um metodo interno ao componente.
3) Acrescento no filho uma seção para habilitar metodos:
dentro de script:
methods:{

	disparaAcao(){
            if(confirm('Confirm a ação')){
                this.$emit('botaoAtivado');
            }
        }   
}
### 4) Esse "botaoAtivado" será respondido lá no pai. Estará la como uma propriedade da tag chamante
meu-botao tipo="button" rotulo="x" @botaoAtivado="remove(cadeia)"/>

5) Já que, de dentro do componente, chamo um método no pai, que está como uma propriedade do pai, posso passar outros dados tb, usando parametros do $emit do filho:
...
if(confirm('Confirm a ação')){
                this.$emit('botaoAtivado','teste');
            }
...
esse "teste" será enviado ao pai
### 6) Para pegar no pai acrescento o parametro do $event

<meu-botao tipo="button" rotulo="x" @botaoAtivado="remove(cadeia)"/></painel-desktop>
<meu-botao tipo="button" rotulo="x" @botaoAtivado="remove($event,cadeia)"/></painel-desktop>

Como estou agora recebendo o $event, posso chama-lo na pagina pai

  methods:{
      remove($event,cadeia){
          alert("Remover linha "+cadeia.nrPro+" "+$event);
      }
  },
### Parametrizando o Botão para ser chamado informando que deve ou não haver confirmação
------------------------------------------------------------------------------------

1) No arquivo do botão acrescento a propriedade "confirmacao" no props, pra receber essa informação do pai

props:['tipo','rotulo','confirmacao']
### 2) Mudo o método disparaAcao() para que confirme ou não conforme veio o parametro
disparaAcao(){
		    if(this.confirmacao){
		        if(confirm('Confirm a ação')){
		            this.$emit('botaoAtivado');
		        }
		        return;
		    }
            	    this.$emit('botaoAtivado');
            }
### 3) No arquivo pai passo o parametro falso ou verdadeiro. Tem que ter o : antes para transfrmar em boolean 
<meu-botao 
      tipo="button" 
      rotulo="Remover" 
      @botaoAtivado="remove(cadeia)"
      :confirmacao="false"/>
### Parametrizando o Botão para ser chamado informando que deve ou não haver confirmação
------------------------------------------------------------------------------------

1) No arquivo do botão acrescento a propriedade "confirmacao" no props, pra receber essa informação do pai

props:['tipo','rotulo','confirmacao']
### 2) Mudo o método disparaAcao() para que confirme ou não conforme veio o parametro
disparaAcao(){
		    if(this.confirmacao){
		        if(confirm('Confirm a ação')){
		            this.$emit('botaoAtivado');
		        }
		        return;
		    }
            	    this.$emit('botaoAtivado');
            }
### 3) No arquivo pai passo o parametro falso ou verdadeiro. Tem que ter o : antes para transfrmar em boolean 
<meu-botao 
      tipo="button" 
      rotulo="Remover" 
      @botaoAtivado="remove(cadeia)"
      :confirmacao="false"/>
### 4) Parametrizando qual será o tipo de botão: botao, botao-padrao,botao-perigo

a) na tag de botão que chama o componente no arquivo home, passar o parametro "estilo" de qual é o botão:
            <meu-botao 
              tipo="button" 
              rotulo="Remover" 
              @botaoAtivado="remove(cadeia)"
              :confirmacao="true"
              estilo="padrao"/>
b)No arquivo do componente botao:
	-criar uma props estilo:
	props:['tipo','rotulo','confirmacao','estilo'],
	 - Criar uma computed 
		computed:{
      		  estiloDoBotao(){
        	    if(this.estilo=='padrao') return 'botao botao-padrao';
        	    if(this.estilo=='perigo') return 'botao botao-perigo';
      		  }
        	}
	- Mudar chamada da classe do botao:
	de   <button @cli…
### POSSO VALIDAR AS PROPRIEDADES RECEBIDAS NO PROPS
------------------------------------------------
O props fica assim:

props:{
        tipo:{
            required:true,
            type:String
        }, 
    rotulo:{
            required:true,
            type:String
        },
    confirmacao:Boolean,
    estilo:String
    },
### FORMULÁRIO
----------

no fim dele coloco uma tag 
<router-link to="/"><meu-botao rotulo="VOLTAR" tipo="button"/></router-link>
Esse botao encaminha para home por causa da rota cadastrada em router "" home

1) pegando dados dos imputs e colocando nas variáveis:

crio um bind no campo input para a variavel no script (dados) mandando o value do campo 

<input id="titulo" autocomplete="off" @input="titulo = $event.target.value">
 ("no @input" quando mudar O CAMPO, muda a VARIAVEL)

2) Criando o metodo que gravará os dados:

	na seção methods
3) na tag de "form" coloco @submit="grava()"
	Cancelo o comportamento padrao do submit (submeter)
	@submit.prevent="grava()"
4) Limpando
	- Para limpar tenho que fazer um bind da fonte de dados para a view
	  :value="titulo…
### a diretiva v-model substitui os dois binds @input="titulo = $event.target.value" :value="titulo"
### Ao inves de:
### <input id="titulo" autocomplete="off" @input="titulo = $event.target.value" :value="titulo">
### faço
### <input id="titulo" autocomplete="off" v-model="titulo">
### se usar o modificador v-model.lazy, só atualizará ao sair do campo
### se usar a diretiva v-show="variavel", se a variavel estiver vazia nao mostra o campo


ROTEIRO PROJETO DJANGO

------------------------------------------------
Sobe ambiente: source venv/bin/activate
Cria Projeto
django-admin startproject
Cria app
django-admin startapp
python3 -m venv ./venv
sudo apt-get install python3
sudo apt-get install python3-pip
python3 --version
python3 -m venv ./venv
source venv/bin/activate
pip install django
pip freeze
criando a pasta de configuração
django-admin startproject config .
python manage.py migrate
mudando arquivo settings
LANGUAGE_CODE = 'pt-br'


TIME_ZONE = 'America/Sao_Paulo'
python manage.py startapp investigacao
mudei configuracao /settings.py


### AMBIENT LARADOCK
### -----------------------------------------
### Criar uma pasta
### git clone https://github.com/laradock/laradock.git
### cp .env.example .env
### Instalando o Docker-compose
### sudo curl -L https://github.com/docker/compose/releases/download/1.25.3/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
### sudo chmod +x /usr/local/bin/docker-compose
### docker-compose up -d nginx mysql phpmyadmin
### Dentro da pasta root (Dev) criar uma pasta public e dentro dela um arquivo php de teste
### criei um index.php
### <?php
phpinfo();
?>
### http://localhost
### http://localhost:8081/ (acesso o mysql)
### COLOCANDO MAIS UMA APLICAÇÃO PRA RODAR

1) na ninha pasta root (/media/darley/Dev/) crio uma pasta public, com um arquivo index.php
<?php
echo("Cadeia de Custódia");
?>
2) tenho que criar uma pasta virtual em laradock/nginx/sites
faco uma cópia de laravel.conf.example
mudando o nome para apliacação (cadeia.conf)
cp laradock/nginx/sites/laravel.conf.example laradock/nginx/sites/cadeia.conf
3) entro no arquivo e 
3.1 mudo o server_name para dev.cadeia
3.2 mudo "root" colocando o endereco root /var/www/cadeia/public
3.2 salvo e vou para /media/darley/Dev/laradock

RESTARTAR OS CONTAINERS

docker-composer restart

ENTRANDO NUM CONTAIER ATIVO PARA EXECUTAR COMANDOS
docker container exec -it dc8d9163a003 /bin/sh


a aplicação vai rodar agora ao chamar dev.cadeia, …
### Ten que ser http://dev.cadeia



#######################################################################

CONFIGURANDO O LARAVEL
----------------------

instalando  o composer
 php -r "readfile('https://getcomposer.org/installer');" | php

criando o projeto dentro de Dev

php composer.phar create-project --prefer-dist laravel/laravel cadeia

para rodar coloquei http://dev.cadeia

modifico arquivo config/app.php
'timezone' => 'America/Sao_Paulo',
Salve

Modifico arquivo .env nio raiz
APP_URL = http://dev.cadeia/
Salve

Dentro de /media/darley/Dev/cadeia
----------------------------------
Cria o módulo com a migration
php artisan make:model Caso -m

Editando o arquivo de migrations:
--------------------------------
Adicionei dois campos na function Up do arquivo migrations (nome do caso e titular)

Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->String('nomeCaso')->unique();
            $table->String('titular');
            $table->timestamps();
        });


Definindo valor padrão para campo de string
-------------------------------------------

entro em app/provider/appServerProvider.php
Adicionei:
use Illuminate\Support\facades\Schema;
No método boot
Schema:: defaultStringLength(191);

Ajustando o arquivo .env
Alterei a seção do mysql:

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=cadeiaCustodia
DB_USERNAME=root
DB_PASSWORD=root

Conheça a collation setado no laravel:
arquivo config/database.php
'charset' => 'utf8mb4',
'collation' => 'utf8mb4_unicode_ci',

Ao criar o banco no mysql usar isso
cadeiaCustodia

Criando as tabelas
php artsan migrate

Criando o controler
php artsan make:controller Api\\CasoController


quando criei as tabelas, php artsan migrate, deu um erro com o nome do servidor de mysql. Mudei o valor da variável DB_HOST=mysql para 127.0.0.1

COLOCANDO MAIS UMA APLICAÇÃO PRA RODAR

1) na ninha pasta root (/media/darley/Dev/) crio uma pasta public, com um arquivo index.php
<?php
echo("Cadeia de Custódia");
?>
2) tenho que criar uma pasta virtual em laradock/nginx/sites
faco uma cópia de laravel.conf.example
mudando o nome para apliacação (cadeia.conf)
cp laradock/nginx/sites/laravel.conf.example laradock/nginx/sites/cadeia.conf
3) entro no arquivo e 
3.1 mudo o server_name para dev.cadeia
3.2 mudo "root" colocando o endereco root /var/www/cadeia/public
3.2 salvo e vou para /media/darley/Dev/laradock

RESTARTAR OS CONTAINERS

docker-composer restart

ENTRANDO NUM CONTAIER ATIVO PARA EXECUTAR COMANDOS
docker container exec -it dc8d9163a003 /bin/sh


a aplicação vai rodar agora ao chamar dev.cadeia, mas para isso tenho que mudar o host do linux etc/hosts para aceitar 127.0.0.1 dev.cadeia

EDITANDO O CONTROLLER
---------------------
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caso;

class CasoController extends Controller
{
    public function index(Caso $caso){
        $casos = $caso->all();
        return response()->json($casos);
    }
}

### DEFININDO ROTAS
### ------------------------------------
### MUDANDO O app/routes/api.php

apago tudo e incluo:
Route::get('casos','App\Http\Controllers\Api\CasoController@index');

MUDANDO O app/routes/web.php

Acrescento no fim:
Route::get('casos','App\Http\Controllers\Api\CasoController@index');
### ------------------------------------
LEVANTANDO OS SERVIÇOS
----------------------------
Dá um defeito na minha máquian porque tenho o mysql rodando, ai faço
ps -ax|grep mysql
sudo systemctl stop mysql
docker-compose restart
### LEVANDO PARA O MODEL LÓGICA DE FILTRO
---------------------------------------
Model caso.php
--------------

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    public function getResults($nomeCaso){
        return $this->where('nomeCaso','LIKE',"%{$nomeCaso}%")
               ->get();
    }
}
### Controller CasoController.php
-----------------------------

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caso;

class CasoController extends Controller
{
    public function index(Caso $caso,Request $request){
        $casos = $caso->getResults($request->nomeCaso);
        return response()->json($casos);
    }
    
}
### -----------------------------------------------
CRIANDO METODO INSERT DA API
----------------------------
1) Crio mais um método no Controller

public function store(Request $request){
        $caso = $this->caso->create($request->all());
        return response()->json($caso,201);
    }

2) Para naõ ficar passando o objeto da entidade no parametro crio uma variável local, e um metodo construtor

private $caso;
    public function __construct(Caso $caso){
        $this->caso=$caso;
    }
3) Na classe Model acrescento um fillable, para poder usar o metodo all() no arquivo de controler, metodo store

protected $fillable=['nomeCaso','titular'];

4) acrescento a rota no arquivo api.php
Route::post('casos','App\Http\Controllers\Api\CasoController@store');
### ------------------------------------------------
CRIANDO O MÉTODO DE ATUALIZAR
------------------------------
1) Arquivo Controller:

public function update(Request $request,$id){
        $caso = $this->caso->find($id);
        if(!$caso)
            return response()->json(['error'=>'Não encontrado'],404);
        $caso->update($request->all());
        return response()->json($caso,200);
    }
2) arquivo de rotas api.php

Route::get('casos','App\Http\Controllers\Api\CasoController@index');
Route::post('casos','App\Http\Controllers\Api\CasoController@store');
Route::put('casos/{id}','App\Http\Controllers\Api\CasoController@update');
### ---------------------------------------
FAZENDO VALIDAÇÕES
--------------------------------------

1) Dou o comando (estando na pasta Dev/cadeia): php artisan make:request StoreUpdateCasoFormRequest
ele criará dentro de app/Http/ a pasta requests com o arquivo StoreUpdateCasoFormRequest.php

2) no arquivo StoreUpdateCasoFormRequest.php:
2.1 mudo autorize para true   
2.2 nbo método rules acrescento: return ['nomeCaso'=>'required|unique:caso',];
3) no Comtroller faço:
3.1 coloco o use use App\Http\Requests\StoreUpdateCasoFormRequest;
3.2 na assinatura do método store troco o Request por StoreUpdateCasoFormRequest
4) para testar as validações com o postman tem que passar uns valores no headers como (content-type e  x-requested-whith)
### https://hpanel.hostinger.com/server/boiling-zephyr.com/218576/overview/
### Painel hospedagem
### AO montar o ambiente de novo teve alguns problemas. No Arquivo.env o DB_HOST teve que ser mudado para mysql; faltou fazer o construct no Controller ai dava mensagem, que o metodo store estava passando null.
### o comando artisan está escrito algumas vezes como artsan
### criei o banco no phpmyadmin
### rodei o comando php artisan migrate
### com a variável DB_HOST=127.0.0.1 no arquivo .env
### no arquivo de rotas api.php posso simplificar as rors
### Subistituindo:
### Route::get('casos','App\Http\Controllers\Api\CasoController@index');
Route::post('casos','App\Http\Controllers\Api\CasoController@store');
Route::put('casos/{id}','App\Http\Controllers\Api\CasoController@update');
Route::delete('casos/{id}','App\Http\Controllers\Api\CasoController@delete');
### or:
### $this->apiResource('casos','App\Http\Controllers\Api\CasoController');
### Nesse caso mudei no controler o metodo delete por destroy
### $this->apiResource('casos','App\Http\Controllers\Api\CasoController');
### Quando o comando php artisan migrate fica dando "nothing to migrate " use o comando : php artisan migrate:reset
### Deu um erro: There is no existing directory at /storage/logs and its not buildable: Permission denied
### por ter apagado e criadu uma table
### Fiz:
### php artisan cache:clear

php artisan route:clear

php artisan dump-autoload
### Deu um erro: There is no existing directory at /storage/logs and its not buildable: Permission denied
### CRIANDO CRUD DE PRODUTOS
------------------------

Criando o model

php artisan make:models Product -m

Crio uma seeder de usuário

php artisan make: seeder UserTableSeeder

Editando arquivo DatabaseSeeder.php
------------------------------------------
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /##
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     $this->call(UserTableSeeder::class);
    }
}
-----------------------------------------------
Editabdo arquivo: UserTableSeeder.php

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /##
     * Run the data…
### CRIANDO UMA ENTIDADE DE CASO
### --------------------------------------------------------
### php artisan make:models Caso -m
### INSTALANDO DOCKER
### ---------------------------------------------------
### sudo apt-get update
### sudo apt-get install \
    ca-certificates \
    curl \
    gnupg \
    lsb-release
### curl -fsSL https://download.docker.com/linux/debian/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
### echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/debian \
  $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
### sudo apt-get update
 sudo apt-get install docker-ce docker-ce-cli containerd.io
### localizar Document_root Apache macos:
### /Library/WebServer/Documents
### restartando apache
### sudo apachectl start
### INSTALANDO E CONFIGURANDO PHP
### -----------------------------------------
### cd /etc/apache2/
sudo cp httpd.conf httpd.conf.Catalina
sudo nano httpd.conf
Descimente a linha
LoadModule php7_module libexec/apache2/libphp7.so
sudo apachectl restart
cd /Library/WebServer/s/
cd /Library/                    
cd WebServer 
sudo nano index.php  
Coloquei o phpinfo()                                                  
apachectl restart
### SUBINDO GIT NO SERVIDOR DO AdminLTE NO LINUX DE CASA
----------------------------------------------------

PAREI OS MYSQL E NGINX  - systemctl stop apache2 systemctl stop MYSQL
PARA STARTAR O CONTAINER TIVE QUE CHEGAR NA PASTA LARADOC - 
cd /home/darley/nomenos/api/laradoc
docker-compose restart

ENTRANDO NO CONTAINER PARA CHEGAR NA PASTA DOCUMENT_ROOT DO NGINX

docker exec -it 0d3c048ae7e1 bash
JA CAI NA POASTA /var/www/public/

git clone https://github.com/darleydias/AdminCustodia.git
### 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
### token git guithub
### github
### git usuario darleydias senha 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
### git de tempos em tempos tem que ir no github em settings desenvolvedor  e gerar toquem. ele é a senha
### INSTALANDO PHP NO DEBIAN
### -------------------------------------------------
### apt update
### pat upgrade
### apt install php
### https://aws.amazon.com/pt/blogs/aws-brasil/autenticando-suas-aplicacoes-atraves-de-reconhecimento-facial-utilizando-o-amazon-cognito-e-o-amazon-rekognition/
### https://codepen.io/ditarahma08/pen/GRRxZLW
### MONTANDO DISPOSITIVO DE LEITURA DE RFC 522 COM ARDUINO
-----------------------------------------------------
lIGAÇÃO 
SDA	Digital 10
SCK	Digital 13
MOSI	Digital 11
MISO	Digital 12
IRQ	unconnected
GND	GND
RST	Digital 9
3.3V	3.3V

SCHETCH
-------

pra funcionar o bootloader tive que fazer:

sudo chmod a+rw /dev/ttyACM0 e importar a biblioteca

/*
 * 
 * All the resources for this project: https://randomnerdtutorials.com/
 * Modified by Rui Santos
 * 
 * Created by FILIPEFLOP
 * 
 */
 
#include <SPI.h>
#include <MFRC522.h>
 
#define SS_PIN 10
#define RST_PIN 9
MFRC522 mfrc522(SS_PIN, RST_PIN);   ###Create MFRC522 instance.
 
void setup() 
{
  Serial.begin(9600);   ###Initiate a serial communication
  SPI.begin();      ###Initiate  SPI bus
  mfrc522.PCD_Init(); …

### ova senha git
### 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
### http://194.163.44.230/AdminCustodia/index3.php
### Novo token senha github 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
### instalando mysql no debian
### wget https://dev.mysql.com/get/mysql-apt-config_0.8.22-1_all.deb
sudo dpkg -i mysql-apt-config*
sudo apt update
sudo apt install mysql-server
sudo systemctl status mysql
mysqladmin -u root -p version
### INSTALANDO
------------------------------
sudo apt-get install proftpd-basic proftpd-doc

CRIANDO USUARTIO 
------------------------------
sudo adduser --home /var/www/html --shell /bin/false --no-create-home ftpUser
chown -R ftpUser:ftpUser /var/www/html
sudo chown -R ftpUser:ftpUser /var/www/html

Tirando o root da lista de proibidos
------------------------------
sudo nano /etc/ftpusers
/etc/init.d/proftpd stop
/etc/init.d/proftpd start

ACESSANDO 
------------------------------
Sudo sftp root@194.163.44.230
Catelecom()123
### Dra. Paula bom dia. Está confirmada a apresentação para amanha as 10hs?
### Ambiente desenvolvimento AdminCustodia
### ##########################################################
### 1999  sudo systemctl stop apache2
 2000  sudo systemctl stop mysql
 2001  cd nomenos/api/laradock/
 2002  docker-compose restart
### Subindo do desenv para o git:
### /nomenos/api/public/AdminCustodia
### sudo git add * 
sudo git commit -m 'v1.6.1' 
sudo git push
### darleydias
### senha
### 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
### Entrando na Produção:
### ssh root@194.163.44.230
### senha CAtelecom()123
### Document root na produção:
### /var/www/html/AdminCustodia
### git clone https://github.com/darleydias/AdminCustodia.git

### EXPO
### --------
### COMANDO CRIAR PROJETO
### expo init nomeProjeto
### startar]
### expo start
### ou npm start
### instalando o expo
### npm i -g expo-cli
### instalando android studio
### fazer download
### https://developer.android.com/studio?hl=pt&gclid=Cj0KCQjwtvqVBhCVARIsAFUxcRucGN4exH0p01vNH8ck0y1YVAJtnask16Xekfv7GNHl-I3iKxEem2kaAsEqEALw_wcB&gclsrc=aw.ds
### apt search openjdk 
 2000  apt install openjdk-11-jdk
 2001  sudo apt install openjdk-11-jdk
 2002  cd /usr/lib/jvm/java-1.11.0-openjdk-amd64
 2003  ls
 2004  pwd
 2005  export JAVA_HOME=/usr/lib/jvm/java-1.11.0-openjdk-amd64/
 2006  java -version
 2007  cd ~/
 2008  ls
 2009  cd ~/android-studio/bin/
 2010  ls
 2011  ./studio.sh
### na tela de bem vindo, mais... sdk manager
### marcar Android 9.0 (Pie)
### configurando variavel de ambiente do android:
### sudo nano $HOME/.bash_profile
### dentro do arquivo colocar:
### export ANDROID_HOME=$HOME/Android/Sdk
export PATH=$PATH:$ANDROID_HOME/emulator
export PATH=$PATH:$ANDROID_HOME/tools
export PATH=$PATH:$ANDROID_HOME/tools/bin
export PATH=$PATH:$ANDROID_HOME/platform-tools
### source $HOME/.bash_profile
### INSTALANDO REACT
### ----------------------------------
### npx create-react-app cadeiacustodia
### TREINAMENTO REACT
### --------------------------------------------
### FONTES PODEM SER BUSCADAS EM google fonts
### https://fonts.google.com/
### Faço a seleção das fonte e ele me mostra a tag


### Copio e colo as tags <link no index.htm e coloco a chamada no index.css ( font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Robo)
### if binário que verifica nulidade dentro do jsx:
### { (props.title || "--Atributo tilte não informado--") }
### se for chamdo componente sem informar a propriedade, tipo:   <Component/> quando deveria ser : <Component1 id="componente1" title="Aula de Marketing" subtitle="Vendendo mais"/> retornará a msg de erro
### ###import React,{useState} from 'react'; 
###import logo from './logo.svg';
###//import './App.css';
###import Main from './Main'
###import Header from './Header';

###function App() {
###  const [user,setUser] = useState('Valdir');
###  const [password,setPass] = useState('yhvh77');
###  const onClick = ()=>{
###    alert(user);
###    setPass(22);
###    setUser('Carlos');
###  }
###  const nameContext = React.createContext('name')
###  return (
###    <div className="App">
###      <Header/>
###      <Main user={user} pass={password}/>
### ###      {user}
###      <button type='button' onClick={onClick}>Mostra</button>
###    </div>
###  );
###}

### artisan
### PROJETO CATENA
### -------------------------------------------
### php composer.phar create-project --prefer-dist laravel/laravel catena
### Criei o Projeto👆
### subindo o projeto
### cd ~/nomenos/api/catena
### ./artisan serve
### http://localhost:8000/
### recebendo parametro da rota no controller:
### Quando a view é chamada é passada a variável
### class EvidenciasController extends Controller{
    public function index(Request $request){
        //var_dump($request->query());
        $evidencias=['Computador','penderive','HD'];
        return view('evidencias.index',['evidencias'=>$evidencias]);
    }
    public function create(){
        return view('evidencias.create');
    }
### eturn view('evidencias.index',['evidencias'=>$evidencias]); (arquivo EvidenciasController.php)
### Usando blade: é um template. crio o template e quando ele é chamado pega o conteudo das section nos arquivos que receberam o template e injeta nas tags de section do template
### Configuração de banco:
### Arquivo \config\database( definir parametros de banco) e \vendor\.env (definir variavel de banco)
### Arquivo .env na raiz do site (definir variavel de banco)
### DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cadeiaCustodia
DB_USERNAME=root
DB_PASSWORD=root

Para listar todos os comandos de migrate: php artisan list
Subindo o mysql e nginx:

dentro da pasta nomenos/api/laradock
systemctl stop mysql
docker-compose up -d nginx mysql phpmyadmin	

Deu um problema no namespace porqur ele ficava com uma marca de erro. Era porque tinha uma quebra de linha antes do <?php

Brigas com o migrate: 1) Erro pois falava que nao era compatiovel a chafe estrangeira. Era porque fois crida uma chave com nome id, depois com nome Evid_id, ele ficou pegando a referencia antiga. Resolvi com php artisan cahe:reset 2) A ordem de criação das tabelas importa na foreing key. Troca a ordem mudando a data no nome da migration. 3) Tabela existente. Fui no banco marquei todas tabelas e dropei

Lembrando... para subir um servidor no Laravel, dentro do projeto: ./artisan serve

Deu um erro quando fui excluir uma dado do banco. O erro informava que quando ele tentava fazer um select where id=9, não achava a coluyna id. De fato eu descobri que quando defino no banco um campo id diferente, tipo evid_id, devo declarar esse nome no arquivo de modelo:

protected $primaryKey = 'evid_id';


Quando uma rota consta como n ão exitente, teste: php artisan route:cache


DJANGO

Criando Ambiente:

sudo python3 -m venv ./venv

Subindo Ambiente:

Descubro primeiro onde esta a pasta venv:
pwd – resposta: /home/darley/nomenos/api/catena-dj/venv

Subo, adicionando /bin/activate:
source /home/darley/nomenos/api/catena-dj/venv/bin/activate

Baixando ambiente:
deactivate

Agora vou instalar o projeto dentro do ambiente:

sudo pip install django

Ver os comandos do Django:
django-admin help

Criando projeto (o ponto(.) é para criar na mesma pasta.): 
sudo django-admin startproject catena . 












Ficou assim:





















Deu um pau desgraçado:

Traceback (most recent call last):
  File "manage.py", line 11, in main
    from django.core.management import execute_from_command_line
ModuleNotFoundError: No module named 'django'

The above exception was the direct cause of the following exception:

Traceback (most recent call last):
  File "manage.py", line 22, in <module>
    main()
  File "manage.py", line 17, in main
    ) from exc
ImportError: Couldn't import Django. Are you sure it's installed and available on your PYTHONPATH environment variable? Did you forget to activate a virtual environment?
(venv) darley@nomeno:~/nomenos/api/catena-dj$ python manage.py runserver
Traceback (most recent call last):
  File "manage.py", line 11, in main
    from django.core.management import execute_from_command_line
ModuleNotFoundError: No module named 'django'

The above exception was the direct cause of the following exception:

Traceback (most recent call last):
  File "manage.py", line 22, in <module>
    main()
  File "manage.py", line 17, in main
    ) from exc
ImportError: Couldn't import Django. Are you sure it's installed and available on your PYTHONPATH environment variable? Did you forget to activate a virtual environment?


Resolvi com:
export PYTHONPATH="/usr/local/lib/python3.7/dist-packages/"

Ai veio outro pau:

    self.connect()
  File "/usr/local/lib/python3.7/dist-packages/django/utils/asyncio.py", line 33, in inner
    return func(*args, ##kwargs)
  File "/usr/local/lib/python3.7/dist-packages/django/db/backends/base/base.py", line 200, in connect
    self.connection = self.get_new_connection(conn_params)
  File "/usr/local/lib/python3.7/dist-packages/django/utils/asyncio.py", line 33, in inner
    return func(*args, ##kwargs)
  File "/usr/local/lib/python3.7/dist-packages/django/db/backends/sqlite3/base.py", line 209, in get_new_connection
    conn = Database.connect(##conn_params)
sqlite3.OperationalError: unable to open database file

Resolvi com:

sudo python3 manage.py runserver

ao inves de 

sudo python manage.py runserver


Depois de criado o Projeto, que é uma coleção de configurações da aplicação, dentro do qual esyá o APP, criamos o app:

sudo python3 manage.py startapp appcatela

É preciso registrar o app no projeto. Faço isso no arquivo settings.py do projeto catena:

Pego dentro do arquivo app.py do app o nome registrado:

class AppcatelaConfig(AppConfig):
default_auto_field = 'django.db.models.BigAutoField'
name = 'appcatela'


e cadastro no arquivo settings.py do projeto:

INSTALLED_APPS=

‘appcatena’


Tem que criar um arquivo url.py no app para poder acessar seus links





Na vies.py configurei

from django.shortcuts import render
from django.http import HttpResponse

def index(request):
return HttpResponse('<h1>Evidências</h1>')


Na url.py do projeto faço:



Deu um erro de não reconhecer o:

from django.contrib import admin
from django.urls import path,include

Ai fiz ctrl+shift+p

select interpreter, escolhi o correto

No arquivo urls.py do projeto defino as rotas. Ai incluo a rota index ‘’ para o app appcatena.  

urlpatterns = [
path('', include('appcatena.urls')),
path('admin/', admin.site.urls)
]

como tinha feito include(‘catena.urls’)  ao invés de include(‘appcatena.urls’) ficou dando um loop infinito

Para tyrabalhar com arquivos statiscos (css) tenhon que informar no projeto (onde estão as configurações ) o entereço da pasta templates no app. Arquivo settings seção TEMPLATES.

Dentro do settings temos qe referenciar os arquivos estáticos tambem, criando no fim a variável 

STATIC_ROOT=”static”

Ali também informo o local dos “arquivos”. Para isso crio uma pasta static no projeto (catena)

STATICFILES_DIRS = [
 	os.path.join(BASE_DIR,’static’)
]

Para o python manipúlar melhor com os arqivos estático faco uma cópia da coleção com o comando:

sudo python3 manage.py collectstatic

Para colocar um códigpo python em um html faço
{%    %}

tenho que informar no html haverá arquivos estáticos

{% load static%}

Toda vez que mudar algum arquivo estático tenho quye dar o comando:

sudo python3 manage.py collectstatic


EXTENDENDO PÁGINAS 
====================

Quando um código repete no começo e no fim do html, posso criar os html sem o código repetido e estender o arquivo que conterá o código compartilhado:

Arquivo que compartilha seu código para nm outros “arquivo base.html”:

<!DOCTYPE html>
{% load static%}
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="{% static 'img/favicon.icon'%}">
<title>Home Catena</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<style>
body {
color: #000;
font: 12px Verdana, sans-serif;
}
#conteudo {
width: 70%;
float: right;
text-align: center;
margin-top: 20px;
}
.modal{
width: 300px;
}
.modal-content {
width: 300px; 
}
.list-group-item:hover {
background-color: rgba(59, 57, 57,0.164)!important;
}
</style>
</head>
<body>

<nav class="navbar bg-light shadow">
<div class="container-fluid">
<span class="navbar-brand mb-0 h1 font-italic"> <a href="{% url 'index'%}" class="text-decoration-none text-dark"><img src="{% static 'img/logo.png'%}" width="30" height="30"/> CATENA</a></span>
<button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
<span class="navbar-toggler-icon"></span>
</button>
</div>
</nav>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-fullscreen">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Menu</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<ul class="list-group list-group-flush">
<li class="list-group-item"><a href="{% url 'mba'%}">Cumprimento de MBA</a></li>
<li class="list-group-item">Operações por etapa</li>
<li class="list-group-item">A third item</li>
<li class="list-group-item">A fourth item</li>
<li class="list-group-item">And a fifth one</li>
</ul>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

{% block content%}
{% endblock%}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>

Veja que copartilhei menu e modal. Parta iso funcionar nesse arquivo bastou eu colocar 
{% block content%}
{% endblock%}

Onde esse trecho de código e que será renderizado o código específico de cada arquivo que consome o base. 

Já nos arquivos que consomem os códigos temos que dizer onde começa e acaba o código que entrará no base. 


{% extends 'base.html'%}
{% load static%}
{% block content%}
<h2>Cumprimento de mandado de Busca e apreensão</h2>
{% endblock%}























































































