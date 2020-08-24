# Micro Serviço - Transactions
Esse micro serviço é responsável por executar a transferência de valores entre os usuários. 

### Configurações
| Configuração  | Descrição |
| ------------- | ------------- |
| Webserver     | porta:8087  |
| Mysql         | porta:3307  |
| /etc/hosts    | 127.0.0.1   &nbsp;&nbsp;&nbsp;   pp.transactions  |

&nbsp;

### Endpoints

| Método  | Endpoint| interação |
| ------------- | ------------- | ------------- |
| `POST`   | api/transaction   | chamada externa |
| `POST`   | api/externalAuth  | processo interno|
| `POST`   | api/updateStatus  | processo interno |

&nbsp;

## POST &nbsp;&nbsp; /api/transaction

#### Headers
`token`: token gerado pelo endpoint POST /api/login

#### CURL
```
curl --location --request POST 'pp.transactions:8087/api/transaction' \
--header 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjEsInVzZXJUeXBlc0lkIjoxfQ.iFEtAYZryEdU-IOTzf2kyNrcDe6BWM03VSN--msRdSQ' \
--header 'Content-Type: application/json' \
--data-raw '{
    "payee":5,
    "value":5.3
}'
```
#### Payload
```
{
    "payee":5,
    "value":5.3
}
```
### Response samples
#### 200
`"Transaction executed"`: Transação executada, porém o que define se o dinheiro foi transferido é o status da transação.
#### 412
`"The User Type sended can't make transactions"`: tipo de usuário inválido para efetuar transferência de dinheiro. 
#### 401
`Unauthorized.`: token inválido.<br>
`"Transaction unauthorized"`: Não autorizado pelo autorizador externo.

&nbsp;

## POST &nbsp;&nbsp; /api/check

#### Headers
não possui

#### CURL
```
curl --location --request POST 'pp.transactions:8087/api/check' \
--header 'Content-Type: application/json' \
--data-raw '{
    "transaction_id":1
}'
```
#### Payload
```
{
    "transaction_id":1
}
```

### Response samples
#### 200 
```
{
    "transaction_id": 1,
    "status": {
        "number": 2,
        "description": "Done"
    }
}
```

#### 404
```
{
    "Error": "Transaction not found"
}
```

#### 422
```
{
    "Error": exception->message
}
```

&nbsp;

## POST &nbsp;&nbsp; /api/externalAuth

#### Headers
não possui

#### CURL
```
curl --location --request POST 'pp.transactions:8087/api/externalAuth' \
--data-raw ''
```
#### Payload
não possui

### Response samples
#### 200 - Mock
```
{
    "message": "Autorizado"
}
```

&nbsp;

## POST &nbsp;&nbsp; /api/updateStatus
Status disponíveis são:
- **1:** Transação iniciada.
- **2:** Transferencia efetuada com sucesso.
- **3:** Transferência não efetuada.

#### Headers
não possui

#### CURL
```
curl --location --request POST 'pp.transactions:8087/api/updateStatus' \
--header 'Content-Type: application/json' \
--data-raw '{
    "transaction_id":4,
    "status":3
}'
```
#### Payload
```
{
    "transaction_id":4,
    "status":3
}
```

### Response samples
#### 200 - Mock
```
{
    "message": "Autorizado"
}
```

&nbsp;
