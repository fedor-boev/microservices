app-install:
	cd ./backend/admin/ && ./vendor/bin/sail artisan migrate --seed && ./vendor/bin/sail artisan passport:install

# Step 1 Install composer
dep-install:
	cd ./backend/emails/ && npm i
	cd ./backend/users/ && npm i
	cd ./backend/checkout/ && npm i
	cd ./backend/influencer/ && npm i
	cd ./backend/admin/ && npm i
	cd ./backend/emails/ && composer install
	cd ./backend/users/ && composer install
	cd ./backend/checkout/ && composer install
	cd ./backend/influencer/ && composer install
	cd ./backend/admin/ && composer install

# (optional) Containers update
dep-update:
	cd ./backend/emails/ && ./vendor/bin/sail composer update
	cd ./backend/users/ && ./vendor/bin/sail composer update
	cd ./backend/checkout/ && ./vendor/bin/sail composer update
	cd ./backend/influencer/ && ./vendor/bin/sail composer update
	cd ./backend/admin/ && ./vendor/bin/sail composer update

# Start Project
init:
	docker network create microservices

u:
	docker network create microservices
	cd ./backend/emails/ && ./vendor/bin/sail up -d
	cd ./backend/users/ && ./vendor/bin/sail up -d
	cd ./backend/checkout/ && ./vendor/bin/sail up -d
	cd ./backend/influencer/ && ./vendor/bin/sail up -d
	cd ./backend/admin/ && ./vendor/bin/sail up -d

d:
	cd ./backend/emails/ && ./vendor/bin/sail down
	cd ./backend/users/ && ./vendor/bin/sail down
	cd ./backend/checkout/ && ./vendor/bin/sail down
	cd ./backend/influencer/ && ./vendor/bin/sail down
	cd ./backend/admin/ && ./vendor/bin/sail down
	docker network rm microservices
r:
	cd ./backend/emails/ && ./vendor/bin/sail restart
	cd ./backend/users/ && ./vendor/bin/sail restart
	cd ./backend/checkout/ && ./vendor/bin/sail restart
	cd ./backend/influencer/ && ./vendor/bin/sail restart
	cd ./backend/admin/ && ./vendor/bin/sail restart
b:
	cd ./backend/emails/ && ./vendor/bin/sail build
	cd ./backend/users/ && ./vendor/bin/sail build
	cd ./backend/checkout/ && ./vendor/bin/sail build
	cd ./backend/influencer/ && ./vendor/bin/sail build
	cd ./backend/admin/ && ./vendor/bin/sail build

t:
	cd ./backend/emails/ && ./vendor/bin/sail test
	cd ./backend/users/ && ./vendor/bin/sail test
	cd ./backend/checkout/ && ./vendor/bin/sail test
	cd ./backend/influencer/ && ./vendor/bin/sail test
	cd ./backend/admin/ && ./vendor/bin/sail test

fire:
	cd ./backend/checkout/ && ./vendor/bin/sail artisan fire
update-rankings:
	cd ./backend/influencer/ && ./vendor/bin/sail artisan update:rankings


au-route-list:
	cd ./backend/users/ && ./vendor/bin/sail artisan route:list