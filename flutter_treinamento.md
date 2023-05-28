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

### Executando projeto dentro do VSCode. Dentro do VSCode, no arquivo main faço ctr+F5

Quando fiz isso deu:
The current Dart SDK version is 2.18.5.

Because perguntas requires SDK version >=3.0.2 <4.0.0, version solving failed.
pub get failed (1; Because perguntas requires SDK version >=3.0.2 <4.0.0, version solving failed.)
Exited (1)

Então fiz:

~~~
flutter upgrade --force
~~~


