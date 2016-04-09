# Backend in Laravel 5.1

## Proposal

The idea is to check how is the entire process since install the web framework till the final version
of a Backend application to provide web services for a Single Page Application.

## Instalation


## Best pratices 

Database migrations

1 - Create a table in the database
    php artisan make:migration create_[table name]_table --create=[table name]

2 - Implement the coluns inside the migration file class.

3 - Commit the changes inside the database
	php artisan migrate

4 - Create a model based on the table created 
    php artisan make:model [Table name]  

## Pros
- Easy to install
- Excellent documentation 


## Cons


## Conclusion