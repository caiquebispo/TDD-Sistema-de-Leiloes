# Sistema de Leilões

Este é um sistema de leilões desenvolvido em PHP.

## Pré-requisitos

- Docker
- Docker Compose

## Como executar

1. Clone o repositório:

bash

git clone <url-do-repositorio>

2. Entre no diretório do projeto:
```bash
cd sistema-leiloes
```

3. Construa e inicie os containers:
```bash
docker-compose up -d
```

4. Instale as dependências do projeto:
```bash
docker-compose exec app composer install
```

5. A aplicação estará disponível em:
```
http://localhost:8080
```

## Executando os testes

Para rodar os testes unitários:
```bash
docker-compose exec app vendor/bin/phpunit
```

## Estrutura do projeto

- `src/` - Código fonte da aplicação
- `tests/` - Testes automatizados
- `docker/` - Arquivos de configuração do Docker

## Tecnologias utilizadas

- PHP 8.x
- PHPUnit para testes
- Docker
- Docker Compose

## Desenvolvimento

Para entrar no container da aplicação:
```bash
docker-compose exec app bash
```

## Parando a aplicação

Para parar os containers:
```bash
docker-compose down
```