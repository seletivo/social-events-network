# Social Events Network
=======================

Social event network project for the coderock selection process

See the application running at https://www.elielbatiston.life/

Introduction
------------

**1st Part:** After downloading the project from the git you shold run the instruction `npm install` inside the react_app folder.
This will install all necessary libraries. However, you must have installed the node package manager `(npm)`

NOTE: Please, if necessary ask me to send my vendor folder with all the necessary libraries.

**2nd Part:** After the 1st part, run the instruction `npm start` inside the react_app folder.

**3rd Part:** To run the system you need a database called `social_event_network`. There are 2 ways to create the database.
    - The first way is to create the database in mysql with the name `social_event_network` and then execute the command `vendor/bin/doctrine orm:schema-tool:update --force` inside the project's root folder that it will create all the necessary tables.

    - The second way is to run the `script.sql` inside the Scripts folder and the script will create the database and the necessary tables.

List of third-party libraries
-----------------------------

### Backend

- **tuupola/slim-jwt-auth:** Library responsible for authentication between two parties using a token preventing you from making any request without proper authentication.

- **jms/serializer:** Library responsible for serializing an object to json and for deserializing a json string into an object.

- **symfony/validator:** When you use your anotations, they are responsible for validating the information provided by user, preventing any business rule from being broken. For example, the field cannot be null

- **phpunit/phpunit:** Library responsible for unit tests

- **phpmailer/phpmailer:** Library responsible for sending email

### Frontend

- **axios:** Library responsible for sending requests and receiving responses from the backend

- **form-serialize:** Serialize form fields to submit a form over ajax

- **react:** Library responsible for the development of front-end applications with interactive elements

- **react-bootstrap:** Library offering react built Bootstrap components

- **react-dom:** Provides DOM-specific methods that can be used at the top level of your application

- **react-router-dom:** React standard routing library responsible for managing urls

- **react-scripts:** Contains everything you need as a sub-dependency of your project like webpack, babel, etc.

Tools used
----------

1. __Code:__ The code was the tool used to code the project. The reason is that it is light, easy to use and has several extensions that provide good productivity
2. __Insomnia:__ Tool used to test backend functionality
3. __PHPUnit:__ Tool used to create unit tests
4. __APIDoc:__ Tool used to create api documentation
