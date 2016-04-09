# Backend in Laravel 5.1

## Proposal

The idea is to check how is the entire process since install the web framework till the final version
of a Backend application to provide web services for a Single Page Application.

## Instalation

1 - Create a laravel project and the folder
```sh
	$ composer create-project --prefer-dist laravel/laravel [project name]
```

2 - It grant all access to project folder (It could be better)
```sh
    $ chmod 777 backend_laravel
```

3 - Run the project
```sh
    $ php artisan serve
```
    
4 - Create the database to store the user table and others


## Best pratices 

###Database migrations

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

5 - Create seeders to populate the table to test OR create a unit test.



## Pros
- Easy to install
- Excellent documentation 


## Cons
- 

## Conclusion