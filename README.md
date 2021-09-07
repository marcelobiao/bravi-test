<h1 align="center">
    Desafio Bravi
</h1>

# Desafio 1: Balanced Brackets

Escreva uma função que seja capaz de determinar se um conjunto de Brackets é válido.

## Requisitos
- Node.js 14.x

## Como Executar
```
$ cd desafio_1
$ npm install

# Para execução dos testes:
$ npm run test

# Para execução do app
$ node index.js
# Insira o conjunto de Brackets para ser validado
```

# Desafio 2: Contact List Backend

Escreva uma APi Rest capaz de armazenar as informações de pessoas e seus contatos. 

## Requisitos
- Docker
- Docker-compose

```
$ cd desafio_2
$ cp .env.example .env
$ docker-compose up -d
$ docker exec -i app_bravi composer install
$ docker exec -i app_bravi php artisan migrate
# Api disponível em: http://localhost:8000/api
```

### Rotas api [InsomniaFile](desafio_2/InsomniaFile.json):
```
# People
- get: 'people'
- get: 'people/{people_uuid}'
- Post: 'people'
    Body: {
        "name": string|required,
        "nickName": string|required
    }
- Put: 'people/{people_uuid}'
    Body: {
        "name": string,
        "nickName": string
    }
- Delete: 'people/{people_uuid}'

# People/{people_uuid}/email
- get: 'people/{people_uuid}/email'
- get: 'people/{people_uuid}/email/{email_uuid}'
- Post: 'people/{people_uuid}/email'
    Body: {
        "email": string|required,
    }
- Put: 'people/{people_uuid}/email/{email_uuid}'
    Body: {
        "email": string,
    }
- Delete: 'people/{people_uuid}/email/{email_uuid}'

# People/{people_uuid}/phone
- get: 'people/{people_uuid}/phone'
- get: 'people/{people_uuid}/phone/{phone_uuid}'
- Post: 'people/{people_uuid}/phone'
    Body: {
        "number": numeric|required,
        "isWhatsapp": boolean|required
    }
- Put: 'people/{people_uuid}/phone/{phone_uuid}'
    Body: {
        "number": numeric,
        "isWhatsapp": boolean
    }
- Delete: 'people/{people_uuid}/phone/{phone_uuid}'

```
