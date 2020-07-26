##Guatemala-API

##Requirements
 - PHP >= 7.4.2
 - Mysql >= 5.7.26
 - Laravel >= 7.21.0

##1. Create tables
`php artisan migrate`

##2. Populating the tables

`php artisan db:seed --class=PromotionsTableSeeder`

`php artisan db:seed --class=UsersTableSeeder`

##3. Create Password grant
`php artisan passport:install `

###User admin

**Email:** admin@guatemala.com  
**Password:** admin

##CRUD Routes Promotions

 Index `http://localhost:8000/api/promotions`
 
 Create `http://localhost:8000/api/promotions`
 
 Update `http://localhost:8000/api/promotions/{articleId}`
 
 Show `http://localhost:8000/api/promotions/{articleId}`
 
 Remove `http://localhost:8000/api/promotions/{articleId}`

##API documentation
`http://localhost:8000/api/documentation`

`php artisan l5-swagger:generate`
