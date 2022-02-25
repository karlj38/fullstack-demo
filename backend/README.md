# Introduction:

This project use NestJS with [TypeORM](https://docs.nestjs.com/techniques/database). In order to get you started and 
give you an example the Entity, Controller, and Service for Courses has been created. You might need to add to those 
in order to complete the assignment.

It is recommended to create similar Modules for Trainers, Bookings, Locations, and Students.

At the bottom of this readme you will find more information about NestJS.

# Exercises:

To complete this test, you will need to complete the following tasks:

1. [ ] Load data from *courses.json*, *location.json*, and *trainers.json* into the database. This is a one off
   operation. Can be done by a script or a REST endpoint
2. [ ] Create an Endpoint that based on a **Course**, returns all the **Trainers** available to teach this course.
3. [ ] Create an Endpoint that returns all the **Locations** in a **City**
4. [ ] Create an Endpoint that creates a **Booking**. That endpoint needs to make sure all the conditions are met for
   the booking.


### Bonus tasks
1. [ ] Protect some endpoints with Basic Auth
2. [ ] Protect some endpoints with JWT
3. [ ] Returns all the available **Locations** within a specific Radius based on GPS coordinates
4. [ ] [Write tests for your services and endpoints](https://docs.nestjs.com/fundamentals/testing)


We recommend to use Passport.js for any authentication. See [NestJS documentation](https://docs.nestjs.com/security/authentication)










# NestJS Readme

<p align="center">
  <a href="http://nestjs.com/" target="blank"><img src="https://nestjs.com/img/logo_text.svg" width="320" alt="Nest Logo" /></a>
</p>

[circleci-image]: https://img.shields.io/circleci/build/github/nestjs/nest/master?token=abc123def456
[circleci-url]: https://circleci.com/gh/nestjs/nest

## Description

[Nest](https://github.com/nestjs/nest) is a framework for building efficient, scalable Node.js server-side 
applications. It uses progressive JavaScript, is built with and fully supports TypeScript

## Installation

```bash
$ npm install
```

## Create Modules, Controllers, and Services with [nest cli](https://docs.nestjs.com/cli/overview)

```bash
# Install CLI
$ npm install -g @nestjs/cli

# Create a module:
$ nest generate module module_name
# or shorter:
$ nest g mo module_name

# Create a controller:
$ nest generate controller module_name
# or shorter:
$ nest g co module_name

# Create a service
$ nest generate service module_name
# or shorter:
$ nest g s module_name

```

## Running the app

```bash
#Build
$ npm run build

# development
$ npm run start

# watch mode
$ npm run start:dev

# production mode
$ npm run start:prod
```

## Test

```bash
# unit tests
$ npm run test

# e2e tests
$ npm run test:e2e

# test coverage
$ npm run test:cov
```

## License

  Nest is [MIT licensed](https://github.com/nestjs/nest/blob/master/LICENSE).
