# Micro Serviço - Balance
Esse micro serviço é responsável por gerir as carteiras dos usuários. 

### Configurações
| Configuração  | Descrição |
| ------------- | ------------- |
| Webserver     | porta:8088  |
| Mysql         | porta:3308  |
| /etc/hosts    | 127.0.0.1   &nbsp;&nbsp;&nbsp;   pp.balance  |

&nbsp;

### Endpoints

| Método  | Endpoint| interação |
| ------------- | ------------- | ------------- |
| `POST`   | api/transfer  | processo interno|
| `POST`   | api/addFunds  | chamada externa |

&nbsp;

## POST &nbsp;&nbsp; /api/transaction

#### Headers
não possui

#### CURL
```
curl --location --request POST 'pp.balance:8088/api/transfer' \
--header 'Content-Type: application/json' \
--data-raw '{
    "transaction_id":1,
    "payer": 1,
    "payee": 4,
    "value": 400000
}'
```
#### Payload
```
{
    "transaction_id":1,
    "payer": 1,
    "payee": 4,
    "value": 400000
}
```
### Response samples
Não existe uma tratativa específica, pois esse processo é executado internamente, e idealizado de forma assíncrona, onde não é possivel analisar a resposta.

&nbsp;

## POST &nbsp;&nbsp; /api/addFunds

#### Headers
não possui

#### CURL
```
curl --location --request POST 'pp.balance:8088/api/addFunds' \
--header 'Content-Type: application/json' \
--data-raw '{
    "user_id":1,
    "amount": 10
}'
```
#### Payload
```
{
    "user_id":1,
    "amount": 10
}
```
### Response samples
#### 200
```
{
    "id": 1,
    "created_at": "2020-08-23T17:08:35.000000Z",
    "updated_at": "2020-08-23T23:49:32.000000Z",
    "user_id": 1,
    "balance": 90.7
}
```
#### 412
`"Invalid amount"`: montante inválido informado (<= 0).

#### 422
payload incompleto

&nbsp;
