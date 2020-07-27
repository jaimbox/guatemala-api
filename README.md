## Guatemala-API

## Requirements
 - PHP >= 7.4.2
 - Mysql >= 5.7.26
 - Laravel >= 7.21.0

## 1. Clone repository
To begin, run the following command to download the starter project using Git:

`$ git clone https://github.com/jaimbox/guatemala-api.git`

move into the new folder

`$ cd guatemala-api`

install dependencies

`$ composer install`

Next, create a .env file at the root of the project and populate it with the content found in the .env.example file. You can do this manually or by running the command below:

`$ cp .env.example .env`

## 2. Setting Up the Database
`DB_CONNECTION=mysql`

`DB_HOST=127.0.0.1`

`DB_PORT=3306`

`DB_DATABASE=guatemala`

`DB_USERNAME=guatemala_dba`

`DB_PASSWORD=e=(4HrwEv:YrcLhF`

## 3. Populating the tables
`php artisan migrate`

`php artisan db:seed --class=PromotionsTableSeeder`

`php artisan db:seed --class=UsersTableSeeder`

## 4. Create Password grant
`php artisan passport:install `

### User admin

**Email:** admin@guatemala.com  
**Password:** admin

## Run Serve API
`php artisan serve --host 0.0.0.0`

## CRUD Routes Promotions

 Index `http://localhost:8000/api/promotions`
 
 Create `http://localhost:8000/api/promotions`
 
 Update `http://localhost:8000/api/promotions/{articleId}`
 
 Show `http://localhost:8000/api/promotions/{articleId}`
 
 Remove `http://localhost:8000/api/promotions/{articleId}`

## API documentation
`http://localhost:8000/api/documentation`

`php artisan l5-swagger:generate`
