Contribute to yii2-fractal library
==================================

### Local setup

[Docker](https://docs.docker.com/engine/install/) is required

```bash
git clone git@github.com:php-openapi/yii2-fractal.git
cd yii2-fractal
make up
make installdocker # only once during initiation
```

### Test

Ensure you followed steps mentioned in Local setup, then

```bash
make cli
make test
```

### Switching PHP versions


You can switch the PHP version of the docker runtime by changing the `PHP_VERSION` environment variable in the `.env` file.

If you have no `.env` file yet, create it by copying `.env.dist` to `.env`.

After changing the PHP Version you need to run `make clean_all up` to start the new container with new version.

Example:

```
$ echo "PHP_VERSION=7.4" > .env
$ make clean_all up cli
Stopping yii2-openapi_php_1      ... done # TODO
Stopping yii2-openapi_maria_1    ... done
Stopping yii2-openapi_postgres_1 ... done
Stopping yii2-openapi_mysql_1    ... done
Removing yii2-openapi_php_1      ... done
Removing yii2-openapi_maria_1    ... done
Removing yii2-openapi_postgres_1 ... done
Removing yii2-openapi_mysql_1    ... done
Removing network yii2-openapi_default
Creating network "yii2-openapi_default" with driver "bridge"
Creating yii2-openapi_maria_1    ... done
Creating yii2-openapi_mysql_1    ... done
Creating yii2-openapi_postgres_1 ... done
Creating yii2-openapi_php_1      ... done
docker-compose exec php bash

root@f9928598f841:/app# php -v

PHP 7.4.27 (cli) (built: Jan 26 2022 18:08:44) ( NTS )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
with Zend OPcache v7.4.27, Copyright (c), by Zend Technologies
with Xdebug v2.9.6, Copyright (c) 2002-2020, by Derick Rethans
```




 ### Testing # todo remove

  - Clone project
  - Run `make up`
  - Run once `make installdocker`
  - Run `make testdocker` or `make cli` and inside docker env `make test`
