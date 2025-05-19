#!/bin/bash

ENV="./.env"
EXAMPLE_ENV="./.env.example"
DOCKER_COMPOSE_PATH="./docker-compose.yaml"

copyVars() {
  VAR_NAME=$1
  VAR_VALUE=$(grep "^$VAR_NAME=" "$EXAMPLE_ENV")

  if [ -n "$VAR_VALUE" ]; then
    if ! grep -q "^$VAR_NAME=" "$ENV"; then
      echo "$VAR_VALUE" >> "$ENV"
      echo "Added $VAR_NAME into .env"
    fi
  fi
}

startAndBuildContainers() {
  docker-compose -f $DOCKER_COMPOSE_PATH up -d --build --force-recreate

	docker exec container_app composer install --ignore-platform-reqs
	docker exec container_app php artisan migrate
	docker exec container_app php artisan config:clear
	docker exec container_app php artisan key:generate
#	docker exec container_app php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
#	docker exec container_app php artisan jwt:secret
	docker exec container_app php artisan config:cache
	docker exec container_app php artisan optimize
	echo "✅  Deployment successful."
}

#if [ ! -f "$ENV" ]; then
#    printf "Copying .env file from .env.example\n">&1
#    cp "$EXAMPLE_ENV" "$ENV"
#else
#  copyVars APP_CONTAINER_NAME;
#  copyVars UNIQUE_LINK_SALT;
#fi

source "$ENV"

startAndBuildContainers