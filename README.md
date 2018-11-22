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
and [docker compose](https://docs.docker.com/compose/overview/).
The following instructions are for a GNU/Linux system but can be easily
followed in another system.
It also assume you have [git](https://git-scm.com/) installed but it works
exactly the same if you download the zip file with the code.

## A) Install the Application Using docker

Clone the repository(also works downloading the zip file)

    git clone https://github.com/mattgaviota/challenge-mc.git

Enter to the directory of the app

    cd challenge-mc

To run the application in development, you need install the dependencies.

    docker-compose exec -u 1000 web composer install

After installing this, you may need to configure some permissions. Directories
within the  `storage` and the `bootstrap/cache` directories should be writable
by your web server or Laravel will not run.

Now you simply run

    docker-compose up -d

and then you can start trying the endpoints(http://localhost:8080/vehicles).

## B) Using composer

Alternative, if you don't want to use Docker, you can use *PHP7.2* and
[Composer](https://getcomposer.org/).

Clone the repository(also works downloading the zip file)

    git clone https://github.com/mattgaviota/challenge-mc.git

Enter the repository folder and then to the app folder

    cd challenge-m/apimc

Install the dependencies

    composer install

Run the development server

    composer start

and then you can start trying the endpoints(http://localhost:8080/vehicles).

## Testing

You can try the API after follow the step **A)** or **B)** using this endpoints

    GET http://localhost:8080/vehicles
    POST http://localhost:8080/vehicles

Also there are automatized tests that you can run with **composer**

    cd challenge-m/apimc
  
    composer test

Or if you are using **Docker Compose**

    cd challenge-mc
    
    docker-compose exec -u 1000 web composer test
