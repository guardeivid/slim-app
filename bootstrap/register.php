<?php

// give back errors
$app->add(new \App\Middelware\ValidationErrorsMiddelware($container));

// give back the old input
$app->add(new \App\Middelware\OldInputMiddelware($container));

// give back a csrf generated key
$app->add(new \App\Middelware\CsrfViewMiddelware($container));

// run the crsf check global
//$app->add($container->csrf);

