SETUP and RUN

1. clone this repository
2. enter backend folder
3. rename .env.example to .env and adjust your database connection
4. run ``composer i`` and wait till done
5. run ``php artisan key:generate``
6. run ``php artisan jwt:secret``
7. run ``php artisan migrate`` to import database
8. run ``php artisan serve`` now the api is ready
9. go back to parent folder and get inside frontend folder
10. run ``npm i`` and wait till done
11. run ``npm run serve`` and the frontend is ready