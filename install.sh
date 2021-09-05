#!/bin/bash
echo "Iniciando instalação..."
echo "^.^"

# Subindo o backend.
cd "back-end"
docker-compose up -d

docker exec -t app-php sh -c "
    cd html &&
    composer install &&
    cp .env.example .env &&
    php artisan key:generate &&
    php artisan cache:clear &&
    php artisan route:clear &&
    php artisan config:clear &&
    php artisan view:clear &&
    php artisan migrate:fresh --seed
"

echo "Backend executando em: http://localhost:8000/"

echo "Iniciando Front End"
echo ""

cd ..
cd "front-end"
npm install
npm run serve

echo "Frontend executando em: http://localhost:8080/"
echo ""
echo "Tudo certo!"

