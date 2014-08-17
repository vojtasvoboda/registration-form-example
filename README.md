Registration form example
=========================

Quick registration form in PHP. Server and client validation. Write credentials to database. Sends confirmation e-mail.

Related blog post in czech: [http://blog.vojtasvoboda.cz/registracni-formular-v-nette](http://blog.vojtasvoboda.cz/registracni-formular-v-nette)

Used components:

- [nette/forms](https://github.com/nette/forms) - forms
- [dibi/dibi](https://github.com/dg/dibi) - database layer
- [tracy/tracy](https://github.com/nette/tracy) - debugging and sending errors by e-mail
- [nette-robot-loader](https://github.com/nette/robot-loader) - PHP class autoloader

Installation
------------

1. Download repository or pull it. Folder need to be accesible by your web server.

```
git pull git@github.com:vojtasvoboda/registration-form-example.git
```

2. Run composer:

```
composer install
```

3. Make /temp folder writable

4. Create database with /sql/reservation.sql dump. Database details can be modified in models/Connection.php.

5. Open your folder through web server, e.g. http://localhost/registration-form-example/
