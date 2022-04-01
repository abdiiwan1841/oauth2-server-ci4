# Oauth2 Server Configuration using Codeigniter 4

## Installation

`git clone [url-project]` then `composer install` o `composer update`.

## Setup

Copy `env` to `.env` and configure for your app.

## Database settings

Copy `database.sql` to your database schema. Add the database configuration and connection to your `.env` file.

## Endpoints, requests and responses

| Endpoing   | Method | Content type                      | Authorization | Request                        | Response |
| ---------- | ------ | --------------------------------- | ------------- | ------------------------------ | -------- |
| login/     | post   | application/x-www-form-urlencoded | basic         | username, password, grant_type | token    |
| register/  | post   | multipart/form-data               | no auth       | email, password, phone         | user     |
| me/        | get    | multipart/form-data               | bearer        |                                | user     |
| users/     | get    | multipart/form-data               | bearer        |                                | users    |
| users/{id} | get    | multipart/form-data               | bearer        |                                | user     |
| users/     | post   | multipart/form-data               | bearer        | email, password, phone         | ok/error |
| users/{id} | put    | multipart/form-data               | bearer        | email, password, phone         | ok/error |
| users/{id} | delete | multipart/form-data               | bearer        |                                | ok/error |

## Basic auth

The basic auth autherization with `client` and `secret` the credentials are in `database.sql`.
