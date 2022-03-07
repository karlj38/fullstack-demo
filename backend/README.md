# Exercises:

To complete this test, you will need to complete the following tasks:

1. [X] Load data from *courses.json*, *location.json*, and *trainers.json* into the database. This is a one off
   operation. Can be done by a script or a REST endpoint
2. [X] Create an Endpoint that based on a **Course**, returns all the **Trainers** available to teach this course.
3. [X] Create an Endpoint that returns all the **Locations** in a **City**
4. [X] Create an Endpoint that creates a **Booking**. That endpoint needs to make sure all the conditions are met for
   the booking.


### Bonus tasks
1. [ ] Protect some endpoints with Basic Auth
2. [ ] Protect some endpoints with JWT
3. [X] Returns all the available **Locations** within a specific Radius based on GPS coordinates
4. [ ] [Write tests for your services and endpoints](https://docs.nestjs.com/fundamentals/testing)

## Installation

This backend runs Laravel in [Sail](https://laravel.com/docs/9.x/sail) (a wrapper for Docker).

Please install Docker before proceeding.

To initialise the project:

cd into the backend directory then run:

```sh
./vendor/bin/sail up
```

However, instead of repeatedly typing vendor/bin/sail to execute Sail commands, you may wish to configure a Bash alias that allows you to execute Sail's commands more easily:

```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

```
sail up
```


The first time you run the Sail up command, Sail's application containers will be built on your machine. This could take several minutes. Don't worry, subsequent attempts to start Sail will be much faster.

Once the application's Docker containers have been started, you can access the application in your web browser at: http://localhost.

Although, since this an API backend only, all available routes are within: http://localhost/api.

To stop all of the containers, you may simply press Control + C to stop the container's execution.

## Initialisation

To build the database and import the starting json date as well as additional fake seeder data for Students, and Bookings, run:

```
sail artisan migrate --seed
```
## Available routes
- GET     api/bookings | return a list of Bookings from today onwards

- POST    api/bookings | create a new Booking

- GET     api/bookings/:id | return a specific Booking along with the related Course, Location, Trainer, and Students

- GET     api/courses | return a list of Courses

- GET     api/courses/:id | return a specific Course along with available Trainers

- GET     api/locations | return a list of Locations filterable by either a given city, or latititude/longitude/radius, or finally you can get only a list of cities with the only_cities query parameter

- GET     api/locations/:id | return a specific Location


- GET     api/students | return a list of Students

- GET     api/students/:id | return a specific Student along with enrolled Bookings


- GET     api/trainers | return a list of Trainers filterable by city, or by course_id

- GET     api/trainers/:id | return a specific Trainer along with enrolled Bookings



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
