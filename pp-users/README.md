# Micro Serviço - Users
Esse micro serviço é responsável pelo CRUD de usuários, também gera o **token** de usuário, que é utilizado em outro micro serviço para efetuar a transferência entre eles. 

### Configurações
| Configuração  | Descrição |
| ------------- | ------------- |
| Webserver     | porta:8080  |
| Mysql         | porta:3306  |
| /etc/hosts    | 127.0.0.1   &nbsp;&nbsp;&nbsp;   pp.users  |

&nbsp;

### Endpoints
| Método  | api/user |
| ------------- | ------------- |
| `POST`  | api/user       |
| `GET`   | api/user/{id}  |
| `PUT`   | api/user/id    |
| `DELETE`| api/user/id    |

| Método  | api/types |
| ------------- | ------------- |
| `GET`   | api/types       |
| `GET`   | api/types/{id}  |

| Método  | api/login |
| ------------- | ------------- |
| `POST`  | api/login       |



# POST &nbsp;&nbsp; /api/User
#### CURL
```
curl --location --request POST 'pp.users:8080/api/user' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name":"algum nome",
    "cpf_cnpj":"88800088800",
    "email":"alguem.email@email",
    "password":"123",
    "user_types_id":1
}'
```
#### Payload
```
{
    "name":"algum nome",
    "cpf_cnpj":"88800088800",
    "email":"alguem.email@email",
    "password":"123",
    "user_types_id":1
}
```
## Response samples
#### 200
```

```
