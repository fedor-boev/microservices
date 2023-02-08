install:
	cd ./backend/admin/ && ./vendor/bin/sail artisan migrate --seed && ./vendor/bin/sail artisan passport:install
fresh:
	cd ./backend/admin/ && ./vendor/bin/sail artisan migrate:fresh --seed && ./vendor/bin/sail artisan passport:install
up:
	cd ./backend/admin/ && ./vendor/bin/sail up -d
down:
	cd ./backend/admin/ && ./vendor/bin/sail down
build:
	cd ./backend/admin/ && ./vendor/bin/sail build --no-cache