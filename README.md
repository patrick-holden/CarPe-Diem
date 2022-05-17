# CarPe-Diem
A app to display a collection of cars.

## Description
CarPe-Diem is an object-oriented PHP project, styled with SASS, that fetches and displays information about different cars from a MySQL database.

## Getting Started
Clone this repo:

```bash
git@github.com:iO-Academy/2022-mar-carcollection.git
```
Navigate into the newly created repo:

```bash
cd 2022-mar-carcollection
```

Run this to initialise SASS:

```bash
sass --watch style.scss style.css
```

Create a MySQL database called:

```bash
carsdb
```

Ensure your local database host, username and password details are correct in:

```bash
src/Classes/Services/Database.php
```

Run `initialisation.php` this will create and fill database tables.

Run `index.php` to see the application!

## Authors

[Alec Hamilton](https://github.com/alec-hamilton)

[Daniel Porter](https://github.com/danieljporter21)

[Grace Sessions](https://github.com/gracesessions)

[Pat Holden](https://github.com/patrick-holden)

[Andrew Scott](https://github.com/AndrewScott85)

[Gediminas Melinauskas](https://github.com/Gantthebant)
