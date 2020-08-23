Introdução
========
Antes de começarmos a ver códigos e analisar a documentação dos endpoints de cada micro serviço, vale ressaltar que o projeto foi idealizado de uma forma, porém executado de outra. A idealização desse projeto é de uma estrutura assíncrona, utilizando um serviço de mensageria para efetuar a comunicação entre os micro serviços, tornando-os independentes. A execução da proposta utilizou de uma abstração do serviço de mensageria, deixando o fluxo linear. 

### Proposta Idealizada
![Proposta Idealizada](https://github.com/AlexCampos95/projeto/blob/docs/docs/proposta-ideal.jpeg?raw=true)


### Proposta Executada
![Proposta Executada](https://github.com/AlexCampos95/projeto/blob/docs/docs/proposta-executada.jpeg?raw=true)


Setup do projeto
=======
Utilize o `docker-compose.yml` da raiz (projeto) para subir todos os micro serviços, cada micro serviço também conta com seu próprio `docker-compose.yml` para facilitar o desenvolvimento e manutenção. 


Documentação dos Micro Serviços
====
Vale ressaltar que os micro serviços que interagem com o front-end (ou outro sistema), são o **Users** e **Transactions**, os demais comunicam-se entre si, para atendender a transação. Entretanto também foi criado um ponto de interação no micro serviço **Balance**, para poder adicionar fundos a carteira do usuário. 

&nbsp;

- Micro serviço de usuários - [MS-Users](https://github.com/AlexCampos95/projeto/blob/master/pp-users/README.md "MS-Users")
- Micro serviço de transações - [MS-Transactions](https://github.com/AlexCampos95/projeto/blob/master/pp-transactions/README.md "MS-Transactions")
- Micro serviço de carteira de usuários - [Ms-Balance](https://github.com/AlexCampos95/projeto/blob/master/pp-balance/README.md "Ms-Balance")
