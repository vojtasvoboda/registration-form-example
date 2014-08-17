<?php

require 'vendor/autoload.php';
require 'forms/RegistrationForm.php';
require 'models/Connection.php';
require 'models/Reservations.php';

// enable debugger
Tracy\Debugger::enable();

// create registration form
$form = new RegistrationForm();

// form sent
if ($form->isSubmitted()) {

    // reservations
    $connection = new Connection();
    $reservations = new Reservations($connection);

    // if is form valid
    if ( $form->isValid() ) {

        // then save reservation
        $reservations->create($form->getValues());
        echo "Saved!";

    }

}

// load template
include_once 'templates/index.php';
