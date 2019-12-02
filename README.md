## About Appplication

At NeuroNation, we offer brain training courses to our users to train several domain categories,
such as: memory, reasoning, perception, etc.
Each of these courses is composed of a list of exercises and each exercise belongs to one of the
aforementioned categories.
Users train throughout several sessions on different dates, each of which is composed of a subset
of exercises. When a session finishes, users obtain a certain score based on the points they win
for each of the exercises included in that session depending on how good or bad they resolved
them.
On the user's private area, we offer –among others– a section called ​ Progress in ​ which the users
can follow their own progress in all the categories. These points also serve the purpose of
calculating the ranking of the users in their countries and worldwide.

## Code challenge

Using the brand new performing database schema that you created, you are required to
implement a new REST resource to add to our existing API that should offer the following
functionality to the frontend layer, so that it can display the above graph to the users:
- It must provide an object containing an array of sessions called ​ "history"​ .
- It must provide the following information for each session in the list:
- "score"​ (integer): total points achieved in the session.
- "date"​ (integer): unix timestamp of the session.

## Optional (extra points)

Imagine that now business also wants to display the name of the categories trained within the
very last session below the diagram (i.e.: to show the user a text: "​ Recently trained: Memory,
Concentration " ​ ).
How would you provide them to the frontend layer using the API?
The Rules

- MySQL 5.6 should be used for your solution.
- PHP 7.x should be used for your solution.
- Utilizing any 3rd-party library as support is permitted.
- Unit tests are required for assuring the quality of your implementation.

## Requirments
- PHP >= 7.2
- Laravel >= 6.2
- MySql >= 5.7

## Installation

Follow the steps below:

- `git clone https://github.com/mbbhatti/NeuroNation.git` OR Download the repository
- composer install
- copy .env.example and fill information accordingly
	- DB_CONNECTION=mysql
	- DB_HOST=127.0.0.1
	- DB_PORT=3306
	- DB_DATABASE=homestead
	- DB_USERNAME=homestead
	- DB_PASSWORD=secret
- php artisan key:generate
- php aritsn migrate
- php aritsn db:seed
- php aritsn passport:install
- composer dumpautoload -o
- run server
	- php artisan serve --port=8282

## API Endpoints
	
### Register API

`curl -X POST http://localhost:8282/api/v1/register \
 -H "Accept: application/json" \
 -H "Content-Type: application/json" \
 -d '{"name": "Faisal", "email": "faisalahsan.se@gmail.com", "password": "password", "confirm_password": "password"}'
`

### Loin API

` curl -X POST http://localhost:8282/api/v1/login \
 -H "Accept: application/json" \
 -H "Content-Type: application/json" \
 -d '{ "email": "testcase@test.com", "password": "password"}'
`

### User course sessions API

`curl -X GET http://localhost:8282/api/v1/user/{user_id}/get-user-sessions \
-H "Accept: application/json" \
-H "Authorization: Bearer token-from-login"
`

### User session exercises API

`curl -X GET http://localhost:8282/api/v1/user/{user_id}/get-user-exercises \
-H "Accept: application/json" \
-H "Authorization: Bearer token-from-login"
`


## Web Endpoints

### Register API

`localhost:8282/register`

### Login API

`localhost:8282/login`


## How To Test

'vendor/bin/phpunit'
