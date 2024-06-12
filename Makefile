PHPARGS=-dmemory_limit=64M
#PHPARGS=-dmemory_limit=64M -dzend_extension=xdebug.so -dxdebug.mode=debug -dxdebug.client_host=127.0.0.1 -dxdebug.start_with_request=yes
#PHPARGS=-dmemory_limit=64M -dxdebug.mode=debug

all:

check-style:
	vendor/bin/php-cs-fixer fix src/ --diff --dry-run

fix-style:
	vendor/bin/indent --tabs composer.json
	vendor/bin/indent --spaces .php_cs.dist
	vendor/bin/php-cs-fixer fix src/ --diff

install:
	composer install --prefer-dist --no-interaction

test:
	php $(PHPARGS) vendor/bin/codecept run

clean_all:
	docker-compose down --remove-orphans
	sudo rm -rf tests/tmp/*

up:
	docker-compose build
	docker-compose up -d
	docker-compose run --rm php bash -c 'chmod +rw -R tests/tmp'
	docker-compose run --rm php bash -c 'chmod +rw -R tests/codeception'
	docker-compose run --rm php bash -c 'mkdir -p tests/testapp/runtime && chmod +rw -R tests/testapp/runtime'
	docker-compose run --rm php bash -c 'chmod -R 777 tests/testapp/runtime' # TODO avoid 777

down:
	docker-compose down --remove-orphans

cli:
	docker-compose exec php bash

installdocker:
	docker-compose run --rm php composer install && chmod +x tests/testapp/yii

testdocker:
	docker-compose run --rm php sh -c 'vendor/bin/codecept run --env docker'

.PHONY: all check-style fix-style install test clean clean_all up cli installdocker migrate testdocker

