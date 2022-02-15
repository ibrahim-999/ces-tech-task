# Employee Management 

## Description
This help companies store and manage list of all their employee.

> This project could be extended in the future. This is just complete the tech task.

## Prerequisite
- PHP 8
- Laravel 8
- Mysql for database
- tmplate engine blade

## Installation

### Step 1.
- Begin by cloning this repository to your machine 
```
git clone git@github.com:ibrahim-999/ces-tech-task.git
```

- Install dependencies
```
composer install
```

- Create enviromental file and variables
```
cp .env.example .env
```

- Generate app key
```
php artisan key:generate
```

### Step 2
- Next, create a new database and reference its name and username/password in the projects .env file. Below the database name is "database_name"
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=
```

- Run migration
```
php artisan migrate
```

### Step 3
- before start the serve you need to adjust your mailtrap vars
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=user name from mailtrap
MAIL_PASSWORD=password from mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME="${APP_NAME}"

```

### Step 4
- To start the server, run the command below
```shell
$ php artisan serve
```

## Testin tools
- phpunit

### Testing directory
- AuthTest
- CompanyTest
- EmployeeTest


## Implemented Features
- Users can register on the application
- Users can login into the application
- Users can create a company
- Users can edit company detail
- Users can delete company 
- User sees only company they created on dashboard
- Company can add an employee
- Company can edit employees details
- Company can delete 
- notify for registration
- notify for create employee


## Author
- ibrahim khalaf
