<p align="center">
  <a href="http://nuom.co.uk/" target="blank"><img src="https://assets-global.website-files.
com/60893c95d5c9871201e719d5/60894c461d15a242648ac3ab_logo-black.svg" width="320" alt="Nuom 
Logo" /></a>
</p>

# Nuom's Junior Fullstack Test 

If you are reading this, it's probably because you are thinking of joining our engineering team at [nuom](https://nuom.co.uk). With this test, we will assess:

* Your capacity to write Backend code
* Your capacity to write Frontend code
* Your capacity to create an API using best practices
* Your capacity to write clean code
* Your capacity to communicate your decisions

For this test you are free to use the language and framework which is the most comfortable to you for both the 
Frontend and Backend.
However, we are providing the skeleton of the project using [NestJS](https://nestjs.com/) framework for the backend 
and [VueJS (v3)](https://vuejs.org/) for the Frontend

You are free to use the database of your choice, we recommend [SQLite](https://www.sqlite.org/index.html) to makes 
things simpler, but you can use [MongoDB](https://www.mongodb.com/) if you prefer.

You can choose the way you prefer to connect to the database, the skeleton project use [TypeORM](https://github.com/typeorm/typeorm), 
but you can use any of [Mongoose](https://mongoosejs.com/), [Sequelize](https://sequelize.org/), 
[Prisma](https://github.com/prisma/prisma), etc...

## Structure

The Project consist of 3 folders:
* __backend/initial data__: Contain a JSON file containing the data to be imported to the database
* __backend__: The backend server, it is a NestJS project, but you can replace this folder for any other backend you 
  want. Don't forget to copy the content of the initial data folder first if you want to replace the backend.
* __frontend__: The frontend user interface, it is a Vue project, but you can replace this folder for any other 
  frontend framework you want (React, Angular, Svelte, Lit, etc...)


## Context

You will be building a training booking system for a training company.

- Each booking will need a **course**, a **location**, a **trainer**, and a *list* of **students**.
- Each booking will have a **start date** and an **end date**.
- Each booking will have a *flag* specifying if it is **mandatory** for obtaining of a certificate.
- Each booking can have **comments** added. This is a free text field for adding requirements.
- Each course has a **level** (from 1 to 5) and a **topic** (*Frontend*, *Backend*, *Fullstack*, *Cloud*, or 
  *Security*).
- Each Trainer has also a **level** and **competencies** which represents the list of topic in which they are 
  competent. To keep things simple, we assume the Trainer level is the same for every topic they know.
- In order for a trainer to teach a class, they need to know that topic and to be at least at the same level. For 
  instance to teach a level 2 Frontend course, a Trainer needs to have *Frontend* in their **competencies** list and 
  be at least level 2.
- Some **Trainers** might need wheelchair, so they can only teach in a **Location** that is wheelchair accessible


## Data structure

The data for the **courses**, **locations**, and **trainers** is in their respective JSON files in the initial data 
folder

### Course
* name: String
* topic: "Frontend" | "Backend" | "Fullstack" | "Cloud" | "Security"
* level: Int (from 1 to 5)
* duration: Int (in days from 1 to 3)

### Location
* name: String
* city: String
* latitude: String (latitude GPS coordinates)
* longitude: String (longitude GPS coordinates)
* wheelchairAccessible: Boolean
* country: String (country name only United Kingdom for this exercise)

### Trainer
* firstName: String
* lastName: String
* level: Int (from 1 to 5)
* competencies: Array<String> (List of topics)
* needWheelchair: Boolean
* city: String
* country: String (country name only United Kingdom for this exercise)

### Student
* email: string

### Bookings:
For you to decide


## Exercises:

- You will find a list of tasks for the Backend in [backend/README.md](backend/README.md)
- You will find a list of tasks for the Frontend in [frontend/README.md](frontend/README.md)

## How to submit:
* Create a Fork of this repository
* Clone this repository to you local machine
* Create a new branch for your submission
* Do you work on that branch
* Once you are done, submit a PR with your work
* Send a link to your repository by email to Loic