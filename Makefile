
.SILENT: ;
.ONESHELL: ;
.NOTPARALLEL: ;
help:
	@echo "                          ======================================================"
	@echo "                          Local Help"
	@echo "                          ======================================================"
	@echo "                    help: Display this help menu"
	@echo "                    pull: Pull the latest version of images from the registry"
	@echo "                   build: Build the test project and install dependencies"
	@echo "                      up: Bring up the containers"
	@echo "                 restart: Restart the containers"
	@echo "                    down: Take down the containers"
	@echo "                    test: Run the tests"
	@echo "                    auth: Authenticate the AWS client"
	@echo "                    root: Login to the 'test' container as 'root' user"

build:
	echo "Building Docker Images"
	docker-compose build
	$(MAKE) up

test:
	docker exec $$(docker-compose ps -q workspace) sh -c "vendor/bin/phpunit"

down:
	docker-compose down --volumes --remove-orphans

reload: down up seed

up:
	echo "Starting Containers"
	docker-compose up -d
	sleep 10
	docker-compose up -d

	echo "\nInstalling Composer Dependencies"
	docker exec $$(docker-compose ps -q workspace) sh -c "composer install"
	echo "Done"

root:
	docker exec -it -u root $$(docker-compose ps -q workspace) bash

npm:
	docker exec $$(docker-compose ps -q workspace) sh -c "npm run dev"

clear:
	docker exec $$(docker-compose ps -q workspace) sh -c "composer clear-all \
	    && truncate -s 0 storage/logs/*.log"


ide-helper:
	docker exec $$(docker-compose ps -q workspace) sh -c "php artisan ide-helper:generate \
		&& php artisan ide-helper:meta \
		&& php artisan package:discover"

migrate:
	docker exec $$(docker-compose ps -q workspace) sh -c "php artisan migrate"

seed:
	docker exec $$(docker-compose ps -q workspace) sh -c "php artisan db:seed --force"

worker:
	docker exec -it $$(docker-compose ps -q workspace) sh -c "php artisan queue:work --queue=process_purchase,verify_purchase,complete_purchase"
