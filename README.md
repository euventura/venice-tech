# Status do Projeto
[![Laravel](https://github.com/euventura/venice-tech/actions/workflows/tests.yml/badge.svg?branch=master)](https://github.com/euventura/venice-tech/actions/workflows/tests.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=euventura_venice-tech&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=euventura_venice-tech)
[![codecov](https://codecov.io/gh/euventura/venice-tech/graph/badge.svg?token=9G563VZW2P)](https://codecov.io/gh/euventura/venice-tech)

# Sistema de Filtro de Produtos

Este é um sistema de filtro de produtos desenvolvido com Laravel e Livewire para o teste da Venice Tech

## Teste Online

Fiz um deploy no laravel Cloud para testes rápidos do funcionamento

https://venice-tech.laravel.cloud/



## Requisitos

- Node.js e NPM
- Docker

## Instalação

1. Clone o repositório
```bash
git clone git@github.com:euventura/venice-tech.git
cd venice-tech
cp .env.example .env
```

2. Instale as dependências do PHP
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

3. suba os container o Sail
```bash
./vendor/bin/sail up -d
```
4. Configure o ambiente e rode as migrations
```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
```

5. Execute os Seeders
```bash
    ./vendor/bin/sail artisan db:seed --class=ProductSeeder
```
Pode-se Criar usuários através da interface, mas se quiser um usuário padrão com os dados:
email: venice@teste.com
senha: password
```bash
./vendor/bin/sail artisan db:seed --class=UserSeeder
```

6. Instale as dependências do Node
```bash
npm install
npm run dev
```