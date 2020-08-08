## B2C Marketplace Platform

### Forked off [laravel 5 boilerplate project](https://github.com/rappasoft/laravel-5-boilerplate)
### Developed in [Laradock Development Environment](https://github.com/laradock/laradock)

## Deployment Guide

## I. Clone the project and checkout develop branch

## II. Installing Docker and Docker-compose

Do these steps if you don't have docker and docker-compose installed
1. `sh install-docker.sh`
2. log out
3. log back in

## III. Building the Project

Run the following command on project's root directory
1. `make build` -> This will create the project's images
2. `make up` -> This will start up the containers from the images
3. `make migrate` -> This will migrate the application
4. Open browser and type `http://localhost:8083` to see home page

### The following commands are helpful
* `make root` to log into the application container as root
* > install node packages `npm install`
* > grant permissions `chmod -R 777 storage`
* `make down` to take down containers

### HEROKU COMMANDS
* Change stack `heroku stack:set heroku-18 -a corlapay`
* Heroku log in `heroku login --browser=firefox`
* Heroku logs `heroku logs -t -n 1000 -a corlapay`
* Heroku config env `heroku config:get DATABASE_URL -a corlapay`
* Add heroku app as a git remove `heroku git:remote -a corlapay`
* Keep app in maintenance mode `heroku maintenance:on -a corlapay`

### HOW TO TRANSLATE DICTIONARY FILES

1. unzip lang.zip
2. Translate the files in the 'fr' folder to french
3. N.B Only translate the values not the keys.
4. transalate the content of the file fr.json (we have english on the left and french on the right)
5. unzip locales.zip
6. Translate content of fr.json to english. N.B Only translate the keys
7. files in lang.zip have words starting with ':' e.g :attribute These words are variables and should not be translated
8. files in locales.zip have words enclosed with '{}' e.g {attribute} These words are variables and should not be translated

