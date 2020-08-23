# Micro Serviço - Users
Esse micro serviço é responsável pelo CRUD de usuários, também gera o **token** de usuário, que é utilizado em outro micro serviço para efetuar a transferência entre eles. 

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
