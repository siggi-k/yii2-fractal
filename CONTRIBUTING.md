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

While development, you might need to support multiple versions of PHP. You can run tests locally in a Docker container in a different PHP version.

You can switch the PHP version of the docker runtime by changing the `PHP_VERSION` environment variable in the `.env` file.

If you have no `.env` file yet, create it by copying `.env.dist` to `.env`.

After changing the PHP Version you need to run `make clean_all up cli` or `make down up cli` to start the new container with new version.

Example:

```
$ echo "PHP_VERSION=8.2" > .env
$ make down up cli
docker-compose down --remove-orphans
Stopping yii2-fractal_php_1   ... done
Stopping yii2-fractal_pgsql_1 ... done
Removing yii2-fractal_php_1   ... done
Removing yii2-fractal_pgsql_1 ... done
Removing network yii2-fractal_default
docker-compose build
...
...
...
docker-compose up -d
...
...
...
docker-compose exec php bash
        _ _  __                                             _
       (_|_)/ _|                                           | |
  _   _ _ _| |_ _ __ __ _ _ __ ___   _____      _____  _ __| | __
 | | | | | |  _| '__/ _` | '_ ` _ \ / _ \ \ /\ / / _ \| '__| |/ /
 | |_| | | | | | | | (_| | | | | | |  __/\ V  V / (_) | |  |   <
  \__, |_|_|_| |_|  \__,_|_| |_| |_|\___| \_/\_/ \___/|_|  |_|\_\
   __/ |
  |___/

PHP version: 8.2.20
root@713d31b5ed8c:/app#
```
