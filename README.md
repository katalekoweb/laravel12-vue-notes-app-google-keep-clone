![Notes App - App de notas](https://raw.githubusercontent.com/katalekoweb/laravel12-vue-notes-app-google-keep-clone/refs/heads/main/public/images/notes.png)


### English 
# MultiUser notes app

## Tecnologies used
- Laravel
- Vuejs- Inertiajs
- Mysql
- Docker with Sail

## Laravel Libs

## Vuejs Libs

## Features
- Full Auth with Breeze @DONE
- Notes management @DONE
- Full transalation in English @DONE
- Full transalation in Portugues @TODO

All notes belongs to logged user
## How to install

Note: Make sure you have docker installed in your machine.

### clone the repository
```bash
git clone https://github.com/katalekoweb/laravel12-vue-notes-app-google-keep-clone.git
cd laravel12-vue-notes-app-google-keep-clone
```

### Copy the env file 
```bash
cp .env.example .env
```

### Install the dependencies 
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

### Run the containers with sail
```bash
./vendor/bin/sail up -d
```

### Generate the app key
```bash
./vendor/bin/sail artisan key:generate
```

### Run the migrations and seeders
```bash
./vendor/bin/sail artisan migrate --seed
```

### Install npm dependencies
```bash
./vendor/bin/sail npm i
```

### Buid npm libs
```bash
./vendor/bin/sail npm run build
```

### Open the project in your browser
http://locathost
Login: username:admin@admin.com, password: password

# Portuguese 
# Aplicação de notas multiusuário

## Tecnologias usadas
- Laravel
- Vuejs- Inertiajs
- Mysql
- Docker com Sail

## Bibliotecas Laravel

## Bibliotecas Vuejs

## Funcionalidades
- Autenticação completa com Breeze @DONE
- CRUD completo de notas @DONE
- Tradução completa em inglês @DONE
- Tradução completa em Poetuguês @TODO

Todas as notas registadas pertencem ao usuário logado.

## Como instalar na sua máquina

Note: Para rodar este projeto tenha certeza que você tem o docker instalado em sua máquina.

### clone o repositório
```bash
git clone https://github.com/katalekoweb/laravel12-vue-notes-app-google-keep-clone.git
cd laravel12-vue-notes-app-google-keep-clone
```

### Copie o ficheiro .env
```bash
cp .env.example .env
```

### Instale as dependencias
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

### Rode os containers com o Laravel sail
```bash
./vendor/bin/sail up -d
```

### Gere a chave do programa
```bash
./vendor/bin/sail artisan key:generate
```

### Rode as migrations e os seeders
```bash
./vendor/bin/sail artisan migrate --seed
```

### Instale as dependencias npm
```bash
./vendor/bin/sail npm i
```

### Faça o build das libs npm
```bash
./vendor/bin/sail npm run build
```

### Abra o seu projeto
http://locathost
Login: username:admin@admin.com, senha: password

## My email: juliofeli78@gmail.com
## Linkedin: https://www.linkedin.com/in/juliaokataleko/