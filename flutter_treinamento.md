# Primeira atividade

## Instalação Android Studio

Pelo Ubuntu Software

## Criação emulador 

Pixel 3a

## Instalaçlão do Flutter

sudo snap install flutter --classic

## Local de isntalçaão do SDK

/home/darley/snap/flutter/common/flutter


## Criando Projeto 

~~~ 
sudo flutter create perguntas 
~~~

Ao rodar ‘flutter doctor’ Estava dando erro
Faltava instalar no sdkmanager:

###Outro defeito: falava que não tinha licença:

flutter doctor --android-license

###Criando Projeto:

flutter create catena cd catena code . flutter run

Extensão code runner

ctrl+alt+N ou M

## Rodando a plicação dentro do VSCode. 

### 1) Dentro do VSCode, no arquivo main faço ctr+F5

Quando fiz isso deu:

The current Dart SDK version is 2.18.5.
Because perguntas requires SDK version >=3.0.2 <4.0.0, version solving failed.
pub get failed (1; Because perguntas requires SDK version >=3.0.2 <4.0.0, version solving failed.)
Exited (1)

Então fiz:

~~~
flutter upgrade --force
~~~
### 2) RunApp

Em cima do metodo runApp tem um link run

### 3) Canto Superiro direito, seta pra baixo run whithout debug 

## Executando no próprio smattphone

Estudar a depuração USB do seu dispositivo
Reinicial o VSCode

## Estrutura do Projeto
Pasta dart_toos - Colocar no git.ignore
Pasta Idea - Colocar no git.ignore
Pasta Android - pode ser aberta no Android Stúdio
Pasta buid - contem o compilado
Pasta lib - onde estará nosso código
Pasta Test - pode excluir
Pasta pubspec.yami - configuração do sistema 

ctr+alt+n executa um programa dart, independente de flutter. Tem que ter o plugin code runner instalado O arquivo tem que estar salvo
ctr+d troca uma variável e todas iguais


# Construindo o primeiro Widget

Para indicar um componente e buscar ações como envolver com outro (wraper) uso ctr + .




