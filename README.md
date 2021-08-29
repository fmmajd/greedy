Welcome to my repo!

## About This Project

This project is designed to receive a list of products and articles, 
and decide the best way to produce items based on articles' stock and products' price.

## How Am I Finding an Answer?

For solving this problem, I'm using a greedy algorithm.
In each iteration, I ask myself 
"Which product would give me the most profit, if I wanted to build only THAT ONE product?"
one I find the most profitable product, 
I conduct the result in the database, 
and move on to the next iteration 
with the remaining products.

## The Nature of Requests

To use the algorithm, send a POST request to path: `api/warehouse` 
with two files attached: articles and products(the same format as the ones you gave me).
You can see the postman collection in the `data` folder.

## Get the Project Up and Running

First, copy .env.example file to .env, and populate database info.

Then, up the docker containers:

`docker-compose up -d`

and run composer:

`docker-compose exec php php composer.phar install`

and run the migrations inside the php container:

`docker-compose exec php php artisan migrate`

Now you can use localhost:8000 as the base url for the api.

If you want, you can customize the ports for nginx and database.
use: `DOCKER_APP_PORT` to change the app port from 8000 to your own one;
And use `DOCKER_DATABASE_PORT` to change the db port from 3306;

## What Could Have Been Done Better If I Had More Time

As you know, I had a family crisis during this project 
and so there wasn't a lot of time and energy to do everything I wanted.
Had I been more relaxed and had more time, I would've done:

**MORE TESTS**

YAP, That's the biggest one.

Also, I believe given enough time and dedication, all projects can be more optimized. 
The same applies to this one.

