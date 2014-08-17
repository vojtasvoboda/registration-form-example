<?php

    require 'vendor/autoload.php';
    require 'forms/RegistrationForm.php';

?>
<!doctype html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <title>Reservation form</title>

    <meta name="description" content="" />
    <meta name="copyright" content="" />
    <meta name="language" content="cs" />

    <!-- <script src="js/netteForms.js"></script> -->

    <style>
        th { text-align: right; }
    </style>

</head>
<body>

<?php

// create registration form
$form = new RegistrationForm();

// renders the form
echo $form;

?>

</body>
</html>
