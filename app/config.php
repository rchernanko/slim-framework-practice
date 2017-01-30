<?php

//create array
$config = [];

//array of arrays (associative)
$config['db'] = [];
$config['db']['host'] = 'localhost'; //db is the key, host is the value/key, localhost is the value
$config['db']['user'] = "root";
$config['db']['pass'] = "Bucketlady1986"; //TODO take this out! Work out how to change the pw on the db
$config['db']['db_name'] = "TechTest";

//Get the DI container
$container = $app->getContainer();

//Add config to the container to make it accessible
$container['config'] = $config;