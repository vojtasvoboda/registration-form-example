<?php

// load Composer classes
require 'vendor/autoload.php';

// enable debugger
Tracy\Debugger::enable();
Tracy\Debugger::$email = 'vojtasvoboda.cz@gmail.com';
Tracy\Debugger::$logDirectory = '/log';

// enable robot loader
$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory('forms');
$loader->addDirectory('models');
$loader->setCacheStorage(new Nette\Caching\Storages\FileStorage('temp'));
$loader->register();

// reservations management
$connection = new Connection();
$reservations = new Reservations($connection);

// získáme volné datumy a časy
$dates = $reservations->getDates();
$times = $reservations->getTimes();

// if we have available dates and times
if ( !empty($dates) && !empty($times) ) {

    // create registration form
    $form = new RegistrationForm($dates, $times);

    // form sent and valid
    if ($form->isSuccess()) {

        // form values
        $values = $form->getValues();

        // check e-mail
        if (!$reservations->checkEmail($values->email)) {
            $form->addError('Na tento e-mail je již provedena rezervace.');
        }

        // check date and time
        if (!$reservations->isFree($values->date, $values->time)) {
            $form->addError('Tato hodina je již obsazena, zkuste vybrat jinou.');
        }

        // if is form still valid
        if ($form->isValid()) {

            // then save reservation
            $reservations->create($form->getValues());

            // redirect
            header("HTTP/1.1 303 See Other");
            header("Location: ?done=1");
            exit;

        }

    }

}

// load template
include_once 'templates/index.php';
