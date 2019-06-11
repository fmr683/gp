# Temper Onboarding Flow

PHP application to demostrasrate the site user flow in Highcharts chart.

## Table of Contents 

- [Requirment](#requirment)
- [Installation](#installation)
- [Features](#features)
- [Security](#security)
- [TDD](#tdd)
- [Evolution](#evolution)
- [Screenshot](#screenshot)
- [Documentation](#documentation)
- [Assumption](#assumption)
- [Next](#next)
- [Author](#author)

---
## Requirment

- PHP 7.2^
- Git
- MySQL 5.6.x

## Installation

- Clone the repo to your local machine using `git clone https://github.com/fmr683/gp.git`.
- Execute the `git checkout master`
- Navigate to `cd .\gp\assessment\` directory and execute the `composer install`.
- Start the MYSQL and create the `assessment` database in the MYSQL and make sure DB username is `root` and password is empty and port is `3306` (demo purpose).
- In the same directory execute the `php artisan migrate --seed` command to migrate and seed the tables and data to database.
- Run the `php -S localhost:8000 -t public`.
- Go back to root directory and navigate to `frontend` directory .
- Open the `assessment.html` html file.
- Note: in the login page demo accounts will be displayed.

## Features
- User login/logout.
- Displaying the user flow statistics in the Highcharts chart.

## Security
- JWT token 
- bcrypt password encryption used for the password generation.

## TDD
- `cd .\gp\assessment\`
- `.\vendor\bin\phpunit .\tests\Http\Controllers\UserControllerTest.php`

## Evolution
- [master] <- [develop] <- [Feature branch] (GIT branch evolution).

## Screenshot
- Navigate to `cd .\gp\screen-shots\` and you'll find 2 screen shot of the complete application

## Documentation
- You can import the API postman collection from the directory root `test.postman_collection.json`

## Next?
- Caching the user flow API response.
- Creating the TDD for the User flow API.

## Assumption
- Both client and server applications are running locally.
- API is running on the port localhost:8000
- `.env` purposefully removed from .gitignore to mitigate the any confusions

## Author
- See the full profile in https://www.linkedin.com/in/fazlulrahmanmohideen/
