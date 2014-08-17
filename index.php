<?php

// load all classes
require 'vendor/autoload.php';
require 'forms/RegistrationForm.php';
require 'models/Connection.php';
require 'models/Reservations.php';

// enable debugger
Tracy\Debugger::enable();

// reservations management
$connection = new Connection();
$reservations = new Reservations($connection);

// získáme volné datumy a časy
$dates = $reservations->getDates();
$times = $reservations->getTimes();

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
        echo "Saved!";

    }

}

// load template
include_once 'templates/index.php';
