## RSSReader
### Requirements:

- PHP 7.4.8^
- Composer

Also ensure that your active php.ini has `extension=pdo_sqlite` uncommented.

### Set up:

Clone project into chosen location. 
```
git clone https://github.com/JoeEmery1999/RSSReader
```

Ensure there is a .env file in the root of the project and that it is populated with the following:
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:D5HG2uik4nThUXFkWTCSG5ma4egWGDnycUciZXsiu5Y=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
DB_FOREIGN_KEYS=true
```

Navigate to project root via terminal and run:
``` 
composer install
``` 

Now we need to enable the DB, run:
```
touch database/database.sqlite
```

Once we have this file, and are sure the .env details are correct, build the DB with the following:
```
php artisan migrate
```

Once the migrations have completed, start the project with:
```
php artisan serve
```

This will print out a url to visit, from there you can view the project.



###Testing
To run any unit tests on this application use the following command:
```
php artisan test
``` 
This will run both feature and unit tests. There are currently no additional tests besides the boilerplate.
