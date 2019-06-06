
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

	echo "Starting Docker Containers"
	docker-compose --project-name $(PROJECT_NAME) up -d
	echo "Installing Composer Dependencies"
	docker exec $$(docker-compose --project-name $(PROJECT_NAME) ps -q tests) sh -c "composer install"
	echo "Done"

test-clean:
	docker exec $$(docker-compose --project-name $(PROJECT_NAME) ps -q tests) sh -c "vendor/bin/codecept clean"

test-single:
	echo ${group}
down:
	docker-compose down --volumes --remove-orphans

reload: pull down up

up:
	echo "Starting Containers"
	docker-compose up -d mysql nginx
#	sleep 10
#	docker-compose up -d

	echo "\nInstalling Composer Dependencies"
	docker exec $$(docker-compose ps -q workspace) sh -c "composer install"
	echo "Done"

pull:
	docker pull 190853051067....

auth:
	eval $$(aws ecr get-login --no-include-email)

restart:
	docker-compose restart

update: down pull build

root:
	docker exec -it $$(docker-compose ps -q workspace) bash

flaky-test-tool-ci:
	wget https://s3.eu-central-1.amazonaws.com/maviance.public.apps/flaky
	chmod +x flaky
	./flaky integrationTests/tests/_output/ ${BUILD_NUMBER} tests https://hooks.slack.com/services/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