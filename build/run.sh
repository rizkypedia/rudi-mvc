#!/usr/bin/env bash
set -e
BASEPATH="$(pwd)"
cd $(git rev-parse --show-toplevel)
# Load .env
set -a
[ -f .env.dist ] && . .env.dist
[ -f .env ] && . .env
set +a
cd $BASEPATH

APP_CONTAINER=`docker ps | grep "${PROJECT_NAME}-app"| egrep ".[a-z0-9]*" -o | head -1`
export $(cat .env | xargs)
function cli() {
  echo "### CLI - ${PROJECT_NAME} ###"
  docker exec -it ${APP_CONTAINER} /bin/bash
}

function test() {
  docker-compose -f docker-compose.yml -f docker-compose.testing.yml build
  docker-compose -f docker-compose.yml -f docker-compose.testing.yml up -d
  docker exec ${PROJECT_NAME}-app composer coder-check /var/www/project
  docker exec ${PROJECT_NAME}-app composer code-analyse /var/www/project
  docker exec ${PROJECT_NAME}-app bin/phpunit .
  docker exec ${PROJECT_NAME}-app bin/drush cr
  docker exec ${PROJECT_NAME}-app bin/behat
}


function isFunction() { [[ "$(declare -Ff "$1")" ]]; }

function main() {

    if [[ -z $1 ]]
    then
        help
    else
        if isFunction $1
        then
          eval "$1 $2"
        else
          echo "Command '$1' not found"
        fi
    fi
}

function help() {
  echo "### nrwGOV - Scripts ###"
  echo "test    - Run all tests"
  echo "cli     - Run cli"
  echo "start   - Start environment"
  echo "stop    - Stop environment"
  echo "log     - Show logs"
  echo "setupdb - Config import & Database updates & locale updates"
  echo "import  - Import database <path to gzipped sql dump> (relative to sync-path)"
  echo "install - Installs scripts globally (/usr/local/bin/ppd)"
  echo "help    - ..."
  echo "########################"
}

function setupdb() {
  docker exec ${APP_CONTAINER} bin/drush updb -y --entity-updates
  docker exec ${APP_CONTAINER} bin/drush cim -y
  docker exec ${APP_CONTAINER} bin/drush locale-check && bin/drush locale-update
}

function log() {
  docker-compose logs
}

function build() {
  docker-compose -f docker-compose.yml -f docker-compose.override.yml build
}

function start() {
  docker-compose -f docker-compose.yml -f docker-compose.override.yml up -d
}

function stop() {
  docker-compose -f docker-compose.yml -f docker-compose.override.yml -f docker-compose.testing.yml stop
}

function checkout() {
  git reset --hard && git checkout $1 -f && git clean -fd
  git pull origin $1
  (cd $(git rev-parse --show-toplevel)/${SYNC_PATH} && composer install && import /dump/${DUMP_NAME})
  setupdb
  echo "Environment ready! Branch: $1"
}

function import() {
  local IMPORT_NAME="${1:-/dump/${DUMP_NAME}}"

  docker exec ${APP_CONTAINER} bin/drush sql-drop -y
  docker exec ${APP_CONTAINER} /bin/bash -c "zcat $IMPORT_NAME | bin/drush sql:cli"
  echo "Successfully imported: $IMPORT_NAME"
  setupdb
}

function install() {
  sudo cp "$(pwd)/$0" /usr/local/bin/ppd
  echo "Installed $0 try out 'ppd'"
}

main $1 $2
