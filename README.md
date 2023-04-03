## Real Estate ##

## To Run This Project: ##

Requirements:
-------------

 * php (>=7.3)
 * mysql
 * composer

Steps:
------

 i)  Download and unzip this project

 ii) Make a copy of **.env.example** and rename with **.env**

 iii) Create a database in mysql

 iv) Edit the fields `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` of **.env** file.

 v) Open terminal from project folder

 vi) Run these commands serially without quotation marks

```
    composer update
```

```
    php artisan key:generate
```

```
    php artisan migrate
```

```
    php aritsan serve
```

 vii) Now open any browser and visit [localhost:8000]

Seeding Database:
------

Run below command for seeding:

```
    php artisan db:seed --class=RealEstateSeeder
```

Feature Testing:
------

Run below command for feature testing:

```
    php artisan make:test RealEstateTest
```
