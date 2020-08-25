Introdução
========
Antes de começarmos a ver códigos e analisar a documentação dos endpoints de cada micro serviço, vale ressaltar que o projeto foi idealizado de uma forma, porém executado de outra. A idealização desse projeto é de uma estrutura assíncrona, utilizando um serviço de mensageria para efetuar a comunicação entre os micro serviços, tornando-os independentes. A execução da proposta utilizou de uma abstração do serviço de mensageria, deixando o fluxo linear. 

### Proposta Idealizada
![Proposta Idealizada](https://github.com/AlexCampos95/projeto/blob/master/docs/proposta-ideal.jpeg?raw=true)


### Proposta Executada
![Proposta Executada](https://github.com/AlexCampos95/projeto/blob/master/docs/proposta-executada.jpeg?raw=true)


Setup do projeto
=======
Rode o arquivo `run.sh` para subir todo o projeto com a instalação das dependências, migrations, seeds, etc.(recomendado na primeira execução do projeto). <br/>
Esse processo poder demorar vários minutos, recomendo que deixe o script rodando enquanto toma um cafézinho :coffee: :smile: 
```
~$ sh run.sh
```
Se for fazer o processo manualmente (ou nas demais vezes após configurado) utilize o `docker-compose.yml` da raiz (projeto) para subir todos os micro serviços fazendo intercomunicação. Cada micro serviço também conta com seu próprio `docker-compose.yml` para facilitar o desenvolvimento e manutenção. 
Abaixo seguem as configurações externas para rodar o projeto, lembrando que as configurações(.env) de cada micro serviço são copiadas através do `run.sh`

### Configurações
| Configuração  | Descrição |
| ------------- | ------------- |
| /etc/hosts    | 127.0.0.1   &nbsp;&nbsp;&nbsp;&nbsp;   pp.users <br/> 127.0.0.1   &nbsp;&nbsp;&nbsp;&nbsp;   pp.transactions  <br/> 127.0.0.1   &nbsp;&nbsp;&nbsp;&nbsp;   pp.balance  <br/> 127.0.0.1   &nbsp;&nbsp;&nbsp;&nbsp;   pp.notifications  |
| Postman Collection | [projeto-collection](https://github.com/AlexCampos95/projeto/blob/master/docs/projeto.postman_collection.json "projeto-collection") |
| Users Mysql-Server  | `porta:3306` `root:sqladmin`  |
| Transactions Mysql-Server  | `porta:3307` `root:sqladmin`  |
| Balance Mysql-Server  | `porta:3308` `root:sqladmin`  |



Documentação dos Micro Serviços
====
Vale ressaltar que os micro serviços que interagem com o front-end (ou outro sistema), são o **Users** e **Transactions**, os demais comunicam-se entre si, para atendender a transação. Entretanto também foi criado um ponto de interação no micro serviço **Balance**, para poder adicionar fundos a carteira do usuário. 

&nbsp;

- Micro serviço de usuários - [MS-Users](https://github.com/AlexCampos95/projeto/blob/master/pp-users/README.md "MS-Users")
- Micro serviço de transações - [MS-Transactions](https://github.com/AlexCampos95/projeto/blob/master/pp-transactions/README.md "MS-Transactions")
- Micro serviço de carteira de usuários - [MS-Balance](https://github.com/AlexCampos95/projeto/blob/master/pp-balance/README.md "MS-Balance")
- Micro serviço de notificações - [MS-Notifications](https://github.com/AlexCampos95/projeto/blob/master/pp-notifications/README.md "MS-Notifications")
