# SIMPLE API-TELZIR IN PHP JAVASCRIPT 

#### devido a naturesa "simples" desse desafio foi escolido realizar o codigo nas linguagens "puras" php e javascrip. Apenas com o propositio de demostrar dominio sobre as mesmas.

# telzir
- Sistema feito em php/javascrip para calcular gastos de ligações de telefone da empresa Telzir

## Requisitos essenciais
- O computador que rodar a aplicação deve está conectado a internet, pois os sistema faz uso do framework Bootsrap por CDN e Jquery CDN.

- Oque você precisa ter instalado na máquina
 -Docker-composer  e Composer

## Executar o projeto localmente

- Instalação do Git

            sudo apt -y install git
           
- Clonando o projeto

            git clone https://github.com/MarceSena/lol.git

- Entre no diretorio 

            cd lol/backend/src

- No diretorio:

            digite: composer install

- No diretorio:

            digite: docker-compose up -d

- No seu browser entre no endereço 
            http://localhost:8080/

            diigite as credencias 

            Sistema  : 	 MySQL
            Servidor :  mysql
            Usuário	 :root
            Senha	: secret
            Base de dados : lol

- insira do scrip que se encontra na raiz do projeto 
            arquivo ddd-sql.sql
            abrar o arquivo e cole, ou importe adminer

- No projeto entre no diretorio
            cd frontend

-No diretorio
            click no arquivo index para abrir em seu browser




# utils
- Instalação do docker
            
    - Ambiente Linux

            sudo apt install apt-transport-https ca-certificates curl software-properties-common

            curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

            sudo apt update

            apt-cache policy docker-ce

            sudo apt install docker-ce

            sudo systemctl status docker

            sudo chmod +x /usr/local/bin/docker-compose

- Instalação do docker-composer

         sudo curl -L "https://github.com/docker/compose/releases/download/1.26.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
         
         sudo chmod +x /usr/local/bin/docker-compose
         
         docker-compose --version
         
- Executando o docker composer :

         docker-compose up -d    


  - Permissões do projerto
        
       sudo chmod o+w ./backend/src/config/db -R
    