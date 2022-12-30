# Doctrine type

**You may fork and modify it as you wish**.

Any suggestions are welcomed.

## Usage

* extend **\Drjele\Doctrine\Type\Contract\AbstractEnumType** for enums.
* extend **\Drjele\Doctrine\Type\Contract\AbstractSetType** for sets.

### Symfony

```yaml
doctrine:
    dbal:
        default_connection: master
        connections:
            master:
                url: '%env(resolve:DATABASE_URL)%'
                server_version: '%env(MYSQL_SERVER_VERSION)%'
                mapping_types:
                    enum: string
                    set: string
        types:
            datetime: \Drjele\Doctrine\Type\DateTimeType
            AcmeEnum: \App\Doctrine\Type\AcmeEnum
            AcmeSet: \App\Doctrine\Type\AcmeSet
```

## Todo

* Unit tests.

## Dev

```shell
git clone git@gitlab.com:drjele-doctrine/type.git
cd type/scripts/docker/

# the next instructions allow to run git from inside the container
cp ~/.ssh/id_* ./
NAME="your-name" &&
    EMAIL="your-email" &&
    CONFIG=('#!/bin/bash' 'if command -v git &> /dev/null; then' "    git config --global user.name \"${NAME}\"" "    git config --global user.email \"${EMAIL}\"" 'fi') && printf '%s\n' "${CONFIG[@]}" >> ./.profile_local

docker-compose build && docker-compose up -d
docker-compose exec php sh
composer install

```
