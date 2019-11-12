# Rudi-MVC

Rudi MVC ist a rudimentary MVC Framework for Web Applications. This Project is stil a work in Progress and experimentall, but the Core functionality such as Controller management
is working.

## Pre-Requisits

- PHP 7.1 or higher
- MySql 5.5 or higher
- Docker (optional) as an alternative you can use Apache or nginx Webserver

## Software/packages in Rudi-MVC

Following packages is heavilly used in Rudi-MVC
- [Doctrine ORM](https://www.doctrine-project.org/)
- [Plates PHP](https://platesphp.com/)

Plates PHP is the heart of the templating system in Rudi-MVC

# Installation

Clone the project and a rename the .env.dist in .env. This file contains all necessary Information such as the database credentials.

Go to the project folder (cd project/) and install Rudi MVC via ```composer install```, this should install all necessary packages.

Go back to the root folder and enter ```docker-compose -f docker-compose.yml -f docker-compose.override.yml build``` this should create a rudi mvc docker image

After a successfull build, run the container ```docker-compose up -d```

Go to http://localhost:8080/index.php/welcome then you should see Rudi-MVC welcome Page

If you dont wish to use docker, feel free to use it locally with Apache or nginx webserver.

## Database

### Import database

In setup/db_imports you'll find the sql dump file, which you can import it to your mysql database. In the virtual environment you'll find the dump under the folder /dump

Go to the terminal, and enter following command

```docker exec -it rudi-mvc-app bash```

With this command you'll enter the virtual environment of the app. You can import the database by simply use the mysql Command:

```mysql -u username -p database_name < /dump/rudi-mvc.sql.gz```

### ORM Interactive Shell (Optional)

Rename the project/app/config/database.yml.dist in project/app/config/database.yml and enter here your database credentials. 
Optionally rename the project/config/db_bootstrap.php.dist in project/config/db_bootstrap.php and again place your database credentials here.
This file is necessary, if you wish to interact with doctrine orm shell tools.

## Rudi-MVC Conventions

### Controller

All Controller file are placed under project/app/src/Controller and the class name must have the "Controller" suffix e.g. 

CustomController.php

All Methods (or Actions) in a Controller must have the "Action" suffix e.g. ListAction

### Views Template

All views Template are placed in project/src/Views/Templates and follows this simple convention:
The Folder is named after the Controller and the template file in this folder is called after the Method without their suffix  

Example:

Controller Name: CustomController
Method Name: ListAction

The template should look like this
project/app/src/Views/Templates/Custom/list.php

#### Main Template / Main Layout Template

The main layout template is called project/src/Views/Layout/rudi_template.php
In each Sub Template you have to add following line on the top of template file:

```$this->layout('shared::rudi_template', array('title' => 'Some Title'));```

This will wrap your template content with the main Template.

### URL Conventions

If you want to see the result of the controller just use following conventions

https://yoursite.de/index.php/ControllerName/ActionName e. g. https://yoursite.de/index.php/custom/list 

