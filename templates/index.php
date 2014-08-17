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
        th { text-align: right; }
    </style>

</head>
<body>

<?php if (isset($form)) { ?>
    <?=$form;?>
<?php } else { ?>
    <p>All terms are full.</p>
<?php } ?>

</body>
</html>
