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
- Micro serviço de usuários - [MS-Users](https://github.com/AlexCampos95/projeto/blob/master/pp-users/README.md "MS-Users")
