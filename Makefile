setup:
    @make build
    @make up
    @make composer-update

build:
    docker-compose build --no-cache --force-rm
stop:
    docker-compose stop
up:
    docker-compose up -d
composer-update:
    docker exec codexchange bash -c "compose update"
data:
    docker exec codexchange bash -c "php artisan migrate:fresh --seed"
