# Doctrine type

**NO LONGER MAINTAINED, MOVED TO https://gitlab.com/precision-soft-open-source/doctrine/type**

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
cd type

rm -rf .git/hooks && ln -s ../dev/git-hooks .git/hooks

./dc build && ./dc up -d
```
