install:
	cd ./backend/admin/ && ./vendor/bin/sail artisan migrate --seed && ./vendor/bin/sail artisan passport:install
fresh:
	cd ./backend/admin/ && ./vendor/bin/sail artisan migrate:fresh --seed && ./vendor/bin/sail artisan passport:install
build:
	cd ./backend/admin/ && ./vendor/bin/sail build --no-cache

# Step 1 Install composer
composer-install-local:
	cd ./backend/admin/ && composer install
	cd ./backend/checkout/ && composer install
	cd ./backend/emails/ && composer install
	cd ./backend/influencer/ && composer install
	cd ./backend/users/ && composer install

# (optional) Containers update
composer-update-local:
	cd ./backend/admin/ && ./vendor/bin/sail composer update
	cd ./backend/checkout/ && ./vendor/bin/sail composer update
	cd ./backend/emails/ && ./vendor/bin/sail composer update
	cd ./backend/influencer/ && ./vendor/bin/sail composer update
	cd ./backend/users/ && ./vendor/bin/sail composer update

# Start Project
up:
	cd ./backend/users/ && ./vendor/bin/sail up -d
up-s:
	cd ./backend/checkout/ && ./vendor/bin/sail up -d
	cd ./backend/influencer/ && ./vendor/bin/sail up -d
	cd ./backend/admin/ && ./vendor/bin/sail up -d
	cd ./backend/emails/ && ./vendor/bin/sail up -d

# Stop Project
down:
	cd ./backend/users/ && ./vendor/bin/sail down
	cd ./backend/checkout/ && ./vendor/bin/sail down
	cd ./backend/influencer/ && ./vendor/bin/sail down
	cd ./backend/admin/ && ./vendor/bin/sail down
	cd ./backend/emails/ && ./vendor/bin/sail down

build-up:
	cd ./backend/users/ && ./vendor/bin/sail build
	cd ./backend/checkout/ && ./vendor/bin/sail build
	cd ./backend/influencer/ && ./vendor/bin/sail build
	cd ./backend/admin/ && ./vendor/bin/sail build
	cd ./backend/emails/ && ./vendor/bin/sail build

fire:
	cd ./backend/checkout/ && ./vendor/bin/sail artisan fire
update-rankings:
	cd ./backend/influencer/ && ./vendor/bin/sail artisan update:rankings


au-route-list:
	cd ./backend/users/ && ./vendor/bin/sail artisan route:list