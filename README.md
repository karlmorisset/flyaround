# FlyAround
[ **PHP/Symfony 5 Services Workshop** - Work base repository ]

Workshop instructions: https://wildcodeschool.github.io/workshop-php-symfony-services/

## Setup

1. Clone this project
2. run `yarn install && composer install`
3. in root foler, `cp .env .env.local` and configure your `DATABASE_URL`
4. run `php bin/console doctrine:database:create`
5. run `php bin/console doctrine:migration:migrate`
6. run `php bin/console doctrine:fixtures:load`

This will populate your database with cities data.

Note: Cities Data are parsed from `src/DataFixtures/worldcities_dataset.csv` file.

Should you insert more cities in database, just update `const LIMIT = 20` in `src/DataFixtures/CityFixtures.php` file.

### Available URLs


|Name           |Method     |Scheme |Host  |Path            |
|---            |---        |---    |---   |---             |
|city_index     |GET        |ANY    |ANY   |/city/          |
|city_new       |GET\|POST  |ANY    |ANY   |/city/new       |
|city_show      |GET        |ANY    |ANY   |/city/{id}      |
|city_edit      |GET\|POST  |ANY    |ANY   |/city/{id}/edit |
|city_delete    |DELETE     |ANY    |ANY   |/city/{id}      |
|default        |ANY        |ANY    |ANY   |/               |
