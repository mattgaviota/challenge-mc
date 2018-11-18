# Modus Create PHP API Development Assignment

## Introduction
This is a short coding assignment, in which you will be asked to
implement an API in PHP that calls a "backend API" to get information
about crash test ratings for vehicles.
The underlying API that is to be used here is the [NHTSA NCAP 5 Star
Safety Ratings API](https://one.nhtsa.gov/webapi/Default.aspx?
SafetyRatings/API/5). This requires no sign up / authentication on
your part, and you are not required to study it. The exact calls that
you need to use are provided in this document.

## Requisites

In order to try this application you need install [docker ce](https://docs.docker.com/install/overview/)
and [docker compose](https://docs.docker.com/compose/overview/)
configured in the `.env file`.
The following instructions are for a GNU/Linux system but can be easily
followed in another system.

## Install the Application

Clone the repository

    git clone git@github.com:mattgaviota/challenge-mc.git

Enter to the directory of the app

    cd challenge-mc

To run the application in development, you need install the dependencies.

    docker-compose exec -u 1000 composer install

After installing this, you may need to configure some permissions. Directories
within the  `storage` and the `bootstrap/cache` directories should be writable
by your web server or Laravel will not run.

## Using docker

You can try the application using docker. The steps are the same as above except
instead of using `composer start` you can use

    docker-compose up -d

and then testing the endpoints.
