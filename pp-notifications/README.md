# Micro Serviço - Notifications
Esse micro serviço é responsável por executar envio de notificações. 

### Configurações
| Configuração  | Descrição |
| ------------- | ------------- |
| Webserver     | porta:8089  |
| /etc/hosts    | 127.0.0.1   &nbsp;&nbsp;&nbsp;   pp.notifications  |

&nbsp;

### Endpoints

| Método  | Endpoint| interação |
| ------------- | ------------- | ------------- |
| `POST`   | api/notifyPayee  | processo interno|
| `POST`   | api/externalNotifier  | processo interno |

&nbsp;

## POST &nbsp;&nbsp; /api/notifyPayee

#### Headers
não possui

#### CURL
```
curl --location --request POST 'pp.notifications:8089/api/notifyPayee' \
--header 'Content-Type: application/json' \
--data-raw '{
    "transaction_id":1,
    "payer": 4,
    "payee": 3,
    "value": 5
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
**Para efeito de teste foram adicionados os status a seguir:**
#### 200
`sended`: notificação enviada

#### 401
houve problema no envio da notificação e ela deve retornar para a fila.
```
{
    "error": e->message
}
```

&nbsp;

## POST &nbsp;&nbsp; /api/externalNotifier

#### Headers
não possui

#### CURL
```
curl --location --request POST 'pp.notifications:8089/api/externalNotifier' \
--data-raw ''
```
#### Payload
não possui

### Response samples
#### 200 - Mock
```
{
    "message": "Enviado"
}
```
