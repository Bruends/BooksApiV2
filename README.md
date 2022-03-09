# Books api v2

CRUD rest api with slim php and mysql
rewriting (this api)[https://github.com/BrunoMendes41/simple-php-restful-api], and adding upload files support.

### installing and running:

- first check if you have `php >= 7.4`, `mysql` and `composer` installed  
and if the app is running in a `Web server with URL rewriting`

- then clone the repo:
```bash
git clone https://github.com/BrunoMendes41/BooksApiV2
```

- create a database in sql and execute the queries in the `books.sql` file to create the table.

- change config in `config.php`.

- Install the dependencies with: 
```bash
composer update
```

- After previous steps, open the api folder in terminal and start the server with the command:

```bash
php -S localhost:3000
```



### Endpoints:

`Api base path: http://localhost:3000/books`

#### GET

Get all books:
> GET &nbsp;&nbsp; /books

Find book by id:
> GET &nbsp;&nbsp; /books/{id}

#### POST

##### Adding new Book
endpoint:  
> POST &nbsp;&nbsp; /books

send a `multipart/form-data` body with this fields: 

```
title (required)
author (required)
description (required)
img (image type file, optional)

```
##### Changing book cover
endpoint:  
> POST &nbsp;&nbsp; /books/newCover/{id}

and send the new image in a `multipart/form-data`

```
img (image type file, optional)
```
to remove the book img send a request to this endpoint with an empty `img` field 


#### PUT

##### Update book:
endpoint:  
> PUT &nbsp;&nbsp; /books

send the body in this format:

```
{
    id (required),
    title (required)
    author (required)
    description: (required)
}
```

#### Delete

##### deleting book:
endpoint:
> DELETE &nbsp;&nbsp; /books/{id}
