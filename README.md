# Backend in Laravel 5.1

## Proposal

The idea is to check how is the entire process since install the web framework till the final version
of a Backend application to provide web services for a Single Page Application.

I will try to follow all Laravel best practices while building the application.

## Instalation

1 - Create a laravel project and the folder
```sh
	$ composer create-project --prefer-dist laravel/laravel [project name]
```

2 - It grant all access to project folder (It could be better)
```sh
    $ chmod 777 backend_laravel
```

3 - Change the app name 
```sh
	$ php artisan app:name [App name]
```

3 - Config the project to run in the server without artisan

	3.1 - Change server.php to index.php (@ root directory)
	3.2 - Copy .htaccess from public to root directory
    
4 - Create the database to store the user tables and others

5 - Inside .ENV file  (@ root directory) configure the database connection 

##Database migrations

1 - Create a table in the database
```sh
    $ php artisan make:migration create_[table name]_table --create=[table name]
```

2 - Implement the coluns inside the migration file class.

3 - Commit the changes inside the database
```sh
	$ php artisan migrate
```

4 - Create a model based on the table created 
```sh
    $ php artisan make:model [Table name]  
```

5 - Create seeders to populate the table to test OR create it using unit test.

## Default Authentication module

	Laravel provides two authentication controllers out of the box, see the [documentation][laravel_auth_doc].
	
	There is another [project][laravel_auth_project] describing how to use the authentication module from Laravel and even how to customized it.

## Pros
- Easy to install
- Excellent documentation 
- Big community


## Cons
- The default installation brings a complete set of tools to any web application however if you wish just to build a REST api, it is a heavy alternative.

## Conclusion



[laravel_auth_doc]: <https://laravel.com/docs/5.1/authentication#included-routing>
[laravel_auth_project]: <https://github.com/fpauer/PHP-Laravel>