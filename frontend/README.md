# Nuom course booking


This skeleton project use [Vue3](https://vuejs.org/guide/quick-start.html) with [Vuetify](https://next.vuetifyjs.com/en/getting-started/installation) as the design system.

You are free to use a different design system or a different Frontend framework if you prefer

There is already an example showing the list of available courses.

# Exercise:
1. [X] Browse the list of Upcoming Bookings
2. [X] Browse the list of Trainers
3. [X] Browse the list of Locations
4. [X] Create a Form to add a new Booking:
   [X] It will need to be able to select from the list of courses
   [X] It will need to be able to select from a list of trainers capable of teaching this course
   [X] It will need to be able to select a location based on a city


## Bonus tasks
1. [ ] Add authentication
2. [X] Add sort and filter for courses page
3. [X] Make UI nicer
4. [X] Get available locations based on browsers location
5. [ ] Add [Components unit testing](https://vuejs.org/guide/scaling-up/testing.html#component-testing) using the testing framework of your choice






# Vue default README

<p align="center">
  <a href="https://vuejs.org/" target="blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1024px-Vue.js_Logo_2.svg.png?20170919082558" width="320" alt="VueJs Logo" /></a>
</p>

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=johnsoncodehk.volar) (and disable Vetur) + [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=johnsoncodehk.vscode-typescript-vue-plugin).

## Type Support for `.vue` Imports in TS

TypeScript cannot handle type information for `.vue` imports by default, so we replace the `tsc` CLI with `vue-tsc` for type checking. In editors, we need [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=johnsoncodehk.vscode-typescript-vue-plugin) to make the TypeScript language service aware of `.vue` types.

If the standalone TypeScript plugin doesn't feel fast enough to you, Volar has also implemented a [Take Over Mode](https://github.com/johnsoncodehk/volar/discussions/471#discussioncomment-1361669) that is more performant. You can enable it by the following steps:

1. Disable the built-in TypeScript Extension
    1) Run `Extensions: Show Built-in Extensions` from VSCode's command palette
    2) Find `TypeScript and JavaScript Language Features`, right click and select `Disable (Workspace)`
2. Reload the VSCode window by running `Developer: Reload Window` from the command palette.

## Customize configuration

See [Vite Configuration Reference](https://vitejs.dev/config/).

## Project Setup

```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Type-Check, Compile and Minify for Production

```sh
npm run build
```

### Run Unit Tests with [Vitest](https://vitest.dev/)

```sh
npm run test:unit
```

### Run End-to-End Tests with [Cypress](https://www.cypress.io/)

```sh
npm run build
npm run test:e2e # or `npm run test:e2e:ci` for headless testing
```

### Lint with [ESLint](https://eslint.org/)

```sh
npm run lint
```
