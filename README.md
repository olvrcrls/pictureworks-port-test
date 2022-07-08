## Instructions
- Be sure to have **PHP7.4^** version installed.
- Clone the repo and navigate then open terminal on the project folder.
- Execute commands **composer install** and **npm run dev** to run package managers for both PHP and JS
- Execute command **php artisan key:generate** to generate the project unique key.
- Execute command **php artisan migrate:fresh && php artisan db:seed** to migrate the migrations and seed the database.
- Run **php artisan serve** to run the localhost server and view the ported project.
- For tests, run **php artisan test tests/Feature/UserTest.php**
- Artisan command to update comments of an *existing* user at the database: **php artisan update:comments {user_id} {comment}**
