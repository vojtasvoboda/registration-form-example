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
        .error { color: red; }
        .success { color: green; }
        th { text-align: right; }
    </style>

</head>
<body>

<?php if (isset($_GET['done'])) { ?>
    <p class="success">Registration has been successfully created. E-mail sent.</p>
<?php } ?>

<?php if (isset($form)) { ?>
    <?=$form;?>
<?php } else { ?>
    <p>All terms are full.</p>
<?php } ?>

</body>
</html>
