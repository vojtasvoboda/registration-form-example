<?php

require 'vendor/autoload.php';

?>
<!doctype html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <title>Reservation form</title>

    <meta name="description" content="" />
    <meta name="copyright" content="" />
    <meta name="language" content="cs" />

    <script src="vendor/nette/forms/src/assets/netteForms.js"></script>

    <style>
        .required label { color: maroon }
    </style>

</head>
<body>

<?php

use Nette\Forms\Form;

$form = new Form;

$form->addText('name', 'Name:');
$form->addPassword('password', 'Password:');
$form->addSubmit('send', 'Register');

// renders the form
echo $form;

?>

</body>
</html>
