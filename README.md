# Capaignmanager-api

## METHODS:

"POST"   = Create
"PUT"    = Update
"GET"    = Get all or Get by id
"DELETE" = Delete data by id

## DOCUMENTATION:

https://documenter.getpostman.com/view/27190902/2s9Y5VSiLw#intro

## HOW TO USAGE

- Ao clonar projeto altere as credenciais do banco
- Rode via comando (so é possivel rodar via cli) os migrations e seeds, exemplo
- - php utils/migration.php up
- - php utils/seeds.php
- Utilize o authkey para pegar o token (cada token expira em 60 minutos)
- utilize as rotas do documeto passando o token gerado via Bearer

