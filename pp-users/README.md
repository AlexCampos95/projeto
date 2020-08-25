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
| Método  | api/login |
| ------------- | ------------- |
| `POST`  | api/login       |

| Método  | api/user |
| ------------- | ------------- |
| `POST`  | api/user       |
| `GET`   | api/user/{id}  |
| `PUT`   | api/user/{id}  |
| `DELETE`| api/user/{id}  |

| Método  | api/types |
| ------------- | ------------- |
| `GET`   | api/types       |
| `GET`   | api/types/{id}  |

&nbsp;

# /api/login
## POST &nbsp;&nbsp; /api/login
#### Headers
não possui

#### CURL
```
curl --location --request POST 'pp.users:8080/api/login' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email":"teste.email@email",
    "password":"123"
}'
```
#### Payload
```
{
    "email":"teste.email@email",
    "password":"123"
}
```
### Response samples
#### 200
```
{
    "0": {
        "id": 6,
        "created_at": "2020-08-23T21:02:51.000000Z",
        "updated_at": "2020-08-23T21:02:51.000000Z",
        "name": "teste",
        "email": "teste.email@email",
        "user_types_id": 1,
        "user_type": {
            "id": 1,
            "description": "COMUM",
            "created_at": "2020-08-23T21:00:48.000000Z",
            "updated_at": "2020-08-23T21:00:48.000000Z"
        }
    },
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjYsInVzZXJUeXBlc0lkIjoxfQ.pDDSsWenJc8GSxKwN00B_-hc-EJQF_28bCcWvQyjoe0"
}
```
#### 401
`"Username or password is invalid"`: usuário e/ou senha inválidos.


&nbsp;

# /api/user
## POST &nbsp;&nbsp; /api/user
#### Headers
não possui
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
### Response samples
#### 201
```
{
    "name": "teste",
    "email": "teste.email@email",
    "user_types_id": 1,
    "updated_at": "2020-08-23T21:02:51.000000Z",
    "created_at": "2020-08-23T21:02:51.000000Z",
    "id": 6,
    "user_type": {
        "id": 1,
        "description": "COMUM",
        "created_at": "2020-08-23T21:00:48.000000Z",
        "updated_at": "2020-08-23T21:00:48.000000Z"
    }
}
```
#### 422
`"User type ID entered does not exist"`: Tipo de usuário inexistente, consulte o endpoint **GET /api/types** para saber os tipos válidos.<br>
`"E-mail already exists"`: Email já cadastrado, informe outro email.<br>
`"CPF or CNPJ already exists"`: CPF ou CNPJ já cadastrado, informe outro documento.<br>

&nbsp;

## GET &nbsp;&nbsp; /api/user/{id}
#### Headers
`token`: token gerado pelo endpoint POST /api/login

#### CURL
```
curl --location --request GET 'pp.users:8080/api/user/6' \
--header 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjEsInVzZXJUeXBlc0lkIjoxfQ.iFEtAYZryEdU-IOTzf2kyNrcDe6BWM03VSN--msRdSQ' \
--data-raw ''
```
#### Payload
não possui

### Response samples
#### 200
```
{
    "id": 6,
    "created_at": "2020-08-23T21:02:51.000000Z",
    "updated_at": "2020-08-23T21:02:51.000000Z",
    "name": "teste",
    "email": "teste.email@email",
    "user_types_id": 1,
    "user_type": {
        "id": 1,
        "description": "COMUM",
        "created_at": "2020-08-23T21:00:48.000000Z",
        "updated_at": "2020-08-23T21:00:48.000000Z"
    }
}
```
#### 404
```
{
    "Error":"User not found"
}
```

#### 401
`Unauthorized.`: token inválido

&nbsp;

## PUT &nbsp;&nbsp; /api/user/{id}
#### Headers
`token`: token gerado pelo endpoint POST /api/login

#### CURL
```
curl --location --request PUT 'pp.users:8080/api/user/54' \
--header 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjEsInVzZXJUeXBlc0lkIjoxfQ.iFEtAYZryEdU-IOTzf2kyNrcDe6BWM03VSN--msRdSQ' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name":"Alex sss"
}'
```

#### Payload
**Os parâmetos são opcionais**
```
{
    "name":"teste",
    "cpf_cnpj":"12345678912",
    "email":"teste.email@email2",
    "password":"123",
    "user_types_id":8
}
```


### Response samples
#### 200
```
{
    "id": 1,
    "created_at": "2020-08-23T21:00:48.000000Z",
    "updated_at": "2020-08-23T21:00:48.000000Z",
    "name": "jose santos",
    "email": "jose.email@email",
    "user_types_id": 1,
    "user_type": {
        "id": 1,
        "description": "COMUM",
        "created_at": "2020-08-23T21:00:48.000000Z",
        "updated_at": "2020-08-23T21:00:48.000000Z"
    }
}
```
#### 404
```
{
    "Error": "User not found"
}
```
#### 401
`Unauthorized.`: token inválido

&nbsp;

## DELETE &nbsp;&nbsp; /api/user/{id}
#### Headers
`token`: token gerado pelo endpoint POST /api/login

#### CURL
```
curl --location --request DELETE 'pp.users:8080/api/user/6' \
--header 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjEsInVzZXJUeXBlc0lkIjoxfQ.iFEtAYZryEdU-IOTzf2kyNrcDe6BWM03VSN--msRdSQ'
```

#### Payload
não possui

### Response samples
#### 204
`<Vazio>`: Usuário removido com sucesso.

#### 404
```
{
    "Error": "User not found"
}
```
#### 401
`Unauthorized.`: token inválido

&nbsp;

# /api/types
## GET &nbsp;&nbsp; /api/types

#### Headers
`token`: token gerado pelo endpoint POST /api/login

#### CURL
```
curl --location --request GET 'pp.users:8080/api/types' \
--header 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjEsInVzZXJUeXBlc0lkIjoxfQ.iFEtAYZryEdU-IOTzf2kyNrcDe6BWM03VSN--msRdSQ' \
--data-raw ''
```

#### Payload
não possui

### Response samples
#### 200
```
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "description": "COMUM",
            "created_at": "2020-08-23T21:00:48.000000Z",
            "updated_at": "2020-08-23T21:00:48.000000Z"
        },
        {
            "id": 2,
            "description": "LOJISTA",
            "created_at": "2020-08-23T21:00:48.000000Z",
            "updated_at": "2020-08-23T21:00:48.000000Z"
        }
    ],
    "first_page_url": "http://pp.users:8080/api/types?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://pp.users:8080/api/types?page=1",
    "next_page_url": null,
    "path": "http://pp.users:8080/api/types",
    "per_page": 15,
    "prev_page_url": null,
    "to": 2,
    "total": 2
}
```
#### 401
`Unauthorized.`: token inválido

## GET &nbsp;&nbsp; /api/types/{id}

#### Headers
`token`: token gerado pelo endpoint POST /api/login

#### CURL
```
curl --location --request GET 'pp.users:8080/api/types' \
--header 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjEsInVzZXJUeXBlc0lkIjoxfQ.iFEtAYZryEdU-IOTzf2kyNrcDe6BWM03VSN--msRdSQ' \
--data-raw ''
```

#### Payload
não possui

### Response samples
#### 200
```
{
    "id": 1,
    "description": "COMUM",
    "created_at": "2020-08-23T21:00:48.000000Z",
    "updated_at": "2020-08-23T21:00:48.000000Z"
}
```
#### 204
`<Vazio>`: Tipo não econtrado.

#### 401
`Unauthorized.`: token inválido
