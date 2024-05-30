<h3>Quick demo in screen recording: </h3>https://www.loom.com/share/190f2d31068549be87690407274d7c4c

<h2>To run the project.</h2>

<h3>Clone the Repo and open the terminal and type.</h3>


git clone https://github.com/davesuy/laravel-vue-simple-task-management.git

cd laravel-vue-simple-task-management

composer install

npm install


<h3>copy .env.example file and rename it to .env and add this to the file</h3>

DB_DATABASE=/your-path/laravel-vue-simple-task-management/database/database.sqlite

<h3>Create Database File:
If the database file does not exist, you need to create it. You can do this manually or by running database migrations:</h3>

touch /your-path/laravel-vue-simple-task-management/database/database.sqlite

<h3>Set Correct Permissions:
Ensure that the directory containing the SQLite database file has the correct permissions so that the Laravel application can read and write to it.</h3>

<h3>Run Migrations (Optional):
If you are using migrations to create database tables, you can run them to create the necessary tables in the SQLite database:</h3>

php artisan migrate


<h3>Run Vite Build:</h3>

npm run build

<h3>Run Server:</h3>

php artisan serve
