# SimplePHPFramework
Simple PHP framework for creating RestAPI 
This project is created to used by beginers or developers who doesnt't want to go deep into the backend.
This small framwork is not well written but can be used in real projects
If you have any remarks or ideas about how  I can make this project better, please contact me via e-mail: amal.akhmadinurov.developer@gmail.com


## Installation
#### Go to Settings/Settings.php
Change this data for connection with your database


```php
$db = new DB("localhost", "user", "pass","database");

```

#### Optional
If you want to use AuthService, you should also change secret key for creating authorizations tokens and you may also change encryption algorithm.
For token generation I use Json Web Token and this implimitation https://github.com/firebase/php-jwt (to see avaliable algorithm go to this page)
```php
TokenService::setAuthParams("testSecretAuthKey", "HS512");
```
You may also change .htaccess file, this line in particular if php folder with framework is not situated in the root directory of your website 

```
RewriteRule . /php/index.php [L]
```
Example 

```
RewriteRule . /my_folder/php/index.php [L]
```

You should not change httpd.config file



## API Reference

The framework is based on idea where every entity should has its own controller. Thus every controller has "actions" 
You can see the example of a simple controller in controllers/TestController.php

All requests to the directory with framework will be redirected to index.php
That's why to avoid error request has to match this format

```
your-domain.ru/php/{name of controller}Controller/{name of action}
```

Here is the example with TestController

```
your-domain.ru/php/Test/showSmth
```

Note that when you wrtting your own controllers after class declaration there should a line like this where variable must have name - controller.


```php
$controller = new YourControllerClassName();
```

You can use TestController as an example

### Utility classes


#### FileLoader
There are some utility classes like AuthService and FileUploader

Example of using FileUploader you can find in Controllers/TestController.php


```php
FileLoader::loadFile({name of filed}, {path to save file});
```

Note: path to save file should be written relitively to the index.php file

#### AuthService

AuthService is an utility which can help you to integrate authentication in your project without big problems

Before using AuthService you have to create a table in your database with three required fileds - Login, Password and Id

Firstly, you need to initialize AuthService and set database object(you can find it as $db in the arguments of a function which declares action), cookie key which will be used as name for cookie and table where data about your users will be storaged

```php
$auth_service = new AuthService($db, "auth_cookie_key", "users");
```

There are several methods which you can use
Examples of them you can find in the TestController
##### auth


```php
$auth_service->auth("login", "password");
```
It is obvious that this method can  authenticate user. 
It returns 0,1 or 2. 
0 means that login was not found.
1 means that password is incorrect.
2 means that user was successfully authenticated and your can use its user id from $_SESSION['UserId']

##### checkAuth

You can check if user is authenticate using this method. If user is not authenticated it will throw an exception and code 401
```php
$auth_service->checkAuth();
```

##### logout
User can logout using this method
```php
$auth_service->logout();
```
