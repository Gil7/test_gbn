# Deploy - Cpanel

1. Download the zip file of this project to your computer

2. Then Upload the file(zip) of the project to your account on Cpanel.

3. In your root directory of Cpanel, Decompress the zip file.

4. After Decompress the zip file you need to move all the files inside of 'public' folder to 'public_html' folder

5. Then, edit 'index.php' file, this file must to be inside 'public_html' folder, change the path in this line, as the follow:

     ```require __DIR__.'/changeThePathuntilthecorrectpathTo/bootstrap/autoload.php';```
    &nbsp; and this line too: &nbsp;
    ```$app = require_once __DIR__.'/changeThePathuntilthecorrectpathTo/bootstrap/app.php';```
    >Note: The 'changeThePath' needs to be changed to the correct path to read the app.php file.

At this point, you must to have a database with the correct credentials, I mean, The database needs to be created with the SQl script file, the file was named 'tutorias.sql' and it's inside of this project folder.

Finally, It's necesary create a file named '.env', in this file you are goint to write the correct credentials to use the database created prviously,
  >In this project there is a file named ".env.example", you can copy and paste this file and then modify it


You need to change only in this part of the file:
Example:

###### APP_NAME=Laravel
###### APP_ENV=production -- this line needs to be changed from "local" to "production"
###### APP_KEY=base64:FjC2P4LO/4MUXs32aNRrE/trWybCCx42gx9y0HS/uwI=
###### APP_DEBUG=false  -- this line needs to be changed from "true" to "false"
###### APP_LOG_LEVEL=debug
###### APP_URL=http://localhost

#### At this section of the file you need to write your credentials for your database.

###### DB_CONNECTION=mysql
###### DB_HOST=localhost
###### DB_PORT=3306
###### DB_DATABASE=CHANGETHISEDATABASENAME
###### DB_USERNAME=CHANGETHISUSERNAME
###### DB_PASSWORD=CHAMGETHISPASSWORD

# HEROKU 
By default, Heroku will launch an Apache web server together with PHP to serve applications from the root directory of the project.
So, we need to create a Procfile that configures the correct document root:
#### Create procfile
echo web: vendor/bin/heroku-php-apache2 public/ Procfile
add the commit
git add . && git commit -m "Procfile for Heroku"

#### Create a new applicacion on Heroku
heroku create

#### Setting a Laravel encryption key
We need to generate a new key for the project

php artisan key:generate --show

then we need to copy this new key and set it on the next command:

heroku config:set APP_KEY=herewewillsetthenewkey

#### Finally we will upload the project to heroku
git push heroku master

#### See the app creted
heroku app