<?php

    require 'vendor/autoload.php';
    require 'forms/RegistrationForm.php';
    require 'models/Connection.php';
    require 'models/Reservations.php';

    // enable debugger
    Tracy\Debugger::enable();

?>
<!doctype html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <title>Reservation form</title>

    <meta name="description" content="" />
    <meta name="copyright" content="" />
    <meta name="language" content="cs" />

    <script src="js/netteForms.js"></script>

    <style>
        th { text-align: right; }
    </style>

</head>
<body>

<?php

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

// renders the form
echo $form;

?>

</body>
</html>
