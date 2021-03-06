Registration form example
=========================

Quick registration form in PHP. Server and client-side validation. Saving registration to database. Sends confirmation e-mail.

Related blog post in czech: [http://blog.vojtasvoboda.cz/registracni-formular-v-nette](http://blog.vojtasvoboda.cz/registracni-formular-v-nette)

Used components:

- [nette/forms](https://github.com/nette/forms) - forms
- [dibi/dibi](https://github.com/dg/dibi) - database layer
- [tracy/tracy](https://github.com/nette/tracy) - debugging and sending errors by e-mail
- [nette-robot-loader](https://github.com/nette/robot-loader) - PHP class autoloader

Installation
------------

- Download repository or pull it. Folder need to be accesible by your web server.

```
git pull git@github.com:vojtasvoboda/registration-form-example.git
```

- Run composer:

```
composer install
```

- Make /temp folder writable

- Create database with /sql/reservation.sql dump. Database details can be modified in models/Connection.php.

- Open your folder through web server, e.g. http://localhost/registration-form-example/
