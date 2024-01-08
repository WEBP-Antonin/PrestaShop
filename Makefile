ROOT_DIR:=$(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

ci-unit:
	php vendor/bin/phpunit -c tests/phpunit-unit.xml

ci-integration:
	php vendor/bin/phpunit -c tests/phpunit-integration.xml

ci-lint:
	./vendor/bin/php-cs-fixer fix --diff --no-interaction --dry-run

# Clean up / remove all the commands below, once e2e is set up in github actions.

run-ps:
	docker network create prestashop-net-${ps_instance}
	docker run -ti --name some-mysql-${ps_instance} --network prestashop-net-${ps_instance} -e MYSQL_ROOT_PASSWORD=admin -e MYSQL_DATABASE=prestashop -p 3307:3306 -d mysql:5.7
	docker run -ti -v $(ROOT_DIR):/var/www/html/modules/klarnapayment -v $(ROOT_DIR)/.docker/php/php.ini:/usr/local/etc/php/conf.d/custom-php.ini --name some-prestashop-${ps_instance} --network prestashop-net-${ps_instance} -e DB_SERVER=some-mysql-${ps_instance} -e PS_INSTALL_AUTO=1 -e DB_NAME=prestashop -e PS_DOMAIN=localhost:8080 -e PS_FOLDER_ADMIN=admin1 -p 8080:80 -d prestashop/prestashop:${ps_instance}

run-latest:
	make run-ps ps_instance=latest

# For our tests . If you develop with local PS version, recommended way would be to run the command below
run-wiremock:
	docker run -d -ti --rm --name wiremock-${ps_instance} --network prestashop-net-${ps_instance} -v $(ROOT_DIR)/wiremock:/home/wiremock -p 8443:8080 wiremock/wiremock

# For local development if you dont use docker for development
run-wiremock-local:
	docker run -ti --rm -v $(ROOT_DIR)/wiremock:/home/wiremock -p 8443:8080 wiremock/wiremock

run-unit-tests:
	docker exec -i some-prestashop-${ps_instance} sh -c "cd /var/www/html/modules/klarnapayment && php vendor/bin/phpunit -c tests/phpunit.xml --testsuite Unit"

run-integration-tests:
	docker exec -i some-prestashop-${ps_instance} sh -c "cd /var/www/html && php bin/console prestashop:module install klarnapayment"
	docker exec -i some-prestashop-${ps_instance} sh -c "cd /var/www/html/modules/klarnapayment && php vendor/bin/phpunit -c tests/phpunit.xml --testsuite Integration"

run-tests-github-actions:
	make run-ps ps_instance=${ps_instance}
	make run-wiremock ps_instance=${ps_instance}
	sleep 2m
	make run-unit-tests ps_instance=${ps_instance}
	make run-integration-tests ps_instance=${ps_instance}

run-local-ps-latest:
	docker-compose -f docker-compose.latest.yml -f docker-compose.local.yml up --build

# Danger command below, if you are in wrong folder, command might have bad consequences
run-purge-local-ps:
	cd ../../ && find . -mindepth 1 ! -regex '^./modules/klarnapayment\(/.*\)?' ! -regex '^./ps-mysql-backup\(/.*\)?' ! -regex '^./.idea\(/.*\)?' -delete

# Commands used for demo server deployment
run-ps-dev:
	docker-compose -f docker-compose.${ps_instance}.yml -p klarnapayment-${ps_instance} up -d --build

#PS1784 CI build
e2eh1784:
	# detaching containers
	docker-compose -f docker-compose.1784.yml up -d --force-recreate
	# sees what containers are running
	docker-compose -f docker-compose.1784.yml ps
	# waiting for app containers to build up
	sleep 90s
	# seeding the customized settings for PS
	mysql -h 127.0.0.1 -P 9002 --protocol=tcp -u root -pprestashop prestashop < ${PWD}/tests/seed/database/prestashop_1784_2.sql
	# installing module
	docker exec -i prestashop-1784 sh -c "cd /var/www/html && php  bin/console prestashop:module install klarnapayment"
	# uninstalling module
	docker exec -i prestashop-1784 sh -c "cd /var/www/html && php  bin/console prestashop:module uninstall klarnapayment"
	# installing the module again
	docker exec -i prestashop-1784 sh -c "cd /var/www/html && php  bin/console prestashop:module install klarnapayment"
	# enabling the module
	docker exec -i prestashop-1784 sh -c "cd /var/www/html && php  bin/console prestashop:module enable klarnapayment"
	# chmod all folders
	docker exec -i prestashop-1784 sh -c "chmod -R 777 /var/www/html"

#PS1784 running on local machine
e2eh1784_local:
	# detaching containers
	docker-compose -f docker-compose.1784.yml up -d --force-recreate
	# sees what containers are running
	docker-compose -f docker-compose.1784.yml ps
	# waiting for app containers to build up
	/bin/bash .docker/wait-loader.sh 8001
	# seeding the customized settings for PS
	mysql -h 127.0.0.1 -P 9002 --protocol=tcp -u root -pprestashop prestashop < ${PWD}/tests/seed/database/prestashop_1784_2.sql
	# installing module
	docker exec -i prestashop-1784 sh -c "cd /var/www/html && php  bin/console prestashop:module install klarnapayment"
	# uninstalling module
	docker exec -i prestashop-1784 sh -c "cd /var/www/html && php  bin/console prestashop:module uninstall klarnapayment"
	# installing the module again
	docker exec -i prestashop-1784 sh -c "cd /var/www/html && php  bin/console prestashop:module install klarnapayment"
	# enabling the module
	docker exec -i prestashop-1784 sh -c "cd /var/www/html && php  bin/console prestashop:module enable klarnapayment"
	# chmod all folders
	docker exec -i prestashop-1784 sh -c "chmod -R 777 /var/www/html"

#PS8 CI build
e2eh8:
	# detaching containers
	docker-compose -f docker-compose.8.yml up -d --force-recreate
	# sees what containers are running
	docker-compose -f docker-compose.8.yml ps
	# waiting for app containers to build up
	sleep 60s
	# seeding the customized settings for PS
	mysql -h 127.0.0.1 -P 9459 --protocol=tcp -u root -pprestashop prestashop < ${PWD}/tests/seed/database/prestashop_812.sql
	# installing module
	docker exec -i prestashop-klarnapayment-8 sh -c "cd /var/www/html && php  bin/console prestashop:module install klarnapayment"
	# uninstalling module
	docker exec -i prestashop-klarnapayment-8 sh -c "cd /var/www/html && php  bin/console prestashop:module uninstall klarnapayment"
	# installing the module again
	docker exec -i prestashop-klarnapayment-8 sh -c "cd /var/www/html && php  bin/console prestashop:module install klarnapayment"
	# enabling the module
	docker exec -i prestashop-klarnapayment-8 sh -c "cd /var/www/html && php  bin/console prestashop:module enable klarnapayment"
	# chmod all folders
	docker exec -i prestashop-klarnapayment-8 sh -c "chmod -R 777 /var/www/html"

#PS8 running on local machine
e2eh8_local:
	# detaching containers
	docker-compose -f docker-compose.8.yml up -d --force-recreate
	# sees what containers are running
	docker-compose -f docker-compose.8.yml ps
	# waiting for app containers to build up
	/bin/bash .docker/wait-loader.sh 8142
	# seeding the customized settings for PS
	mysql -h 127.0.0.1 -P 9459 --protocol=tcp -u root -pprestashop prestashop < ${PWD}/tests/seed/database/prestashop_812.sql
	# installing module
	docker exec -i prestashop-klarnapayment-8 sh -c "cd /var/www/html && php  bin/console prestashop:module install klarnapayment"
	# uninstalling module
	docker exec -i prestashop-klarnapayment-8 sh -c "cd /var/www/html && php  bin/console prestashop:module uninstall klarnapayment"
	# installing the module again
	docker exec -i prestashop-klarnapayment-8 sh -c "cd /var/www/html && php  bin/console prestashop:module install klarnapayment"
	# enabling the module
	docker exec -i prestashop-klarnapayment-8 sh -c "cd /var/www/html && php  bin/console prestashop:module enable klarnapayment"
	# chmod all folders
	docker exec -i prestashop-klarnapayment-8 sh -c "chmod -R 777 /var/www/html"

#PS8 build only
e2eh8_local_build:
	# detaching containers
	docker-compose -f docker-compose.8.yml up -d --force-recreate
	# sees what containers are running
	docker-compose -f docker-compose.8.yml ps
	# waiting for app containers to build up
	/bin/bash .docker/wait-loader.sh
	# seeding the customized settings for PS
	mysql -h 127.0.0.1 -P 9459 --protocol=tcp -u root -pprestashop prestashop < ${PWD}/tests/seed/database/prestashop_812.sql

# Cypress E2E Automation on local machine
run-e2e-tests-locally:
	npm install -D cypress
	npm ci
	npx cypress run

# opening Cypress E2E test runner on local machine - PS1784
open-cypress-locally-PS1784:
	export CYPRESS_baseUrl=https://klarnapayment1784.ngrok.io && npx cypress open

# opening Cypress E2E test runner on local machine - PS8
open-cypress-locally-PS8:
	export CYPRESS_baseUrl=https://klarnapayment8.ngrok.io && npx cypress open

# launching a Ngrok tunnel session on local machine (better new terminal) - PS1784
open-ngrok-1784:
	./ngrok http --region=us --subdomain=klarnapayment1784 8001

# launching a Ngrok tunnel session on local machine (better new terminal) - PS8
open-ngrok-8:
	./ngrok http --region=us --subdomain=klarnapayment8 8142