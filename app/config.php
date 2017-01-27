<?php

//create array
$config = [];

//array of arrays (associative)
$config['db'] = [];
$config['db']['host'] = 'localhost'; //db is the key, host is the value/key, localhost is the value
$config['db']['user'] = "root";
$config['db']['pass'] = "";
$config['db']['db_name'] = "exercises";

//Get the DI container
$container = $app->getContainer();

//Add config to the container to make it accessible
$container['config'] = $config;

//TODO read a little more re: the container and DIC in slim framework

//TODO get above running not on phpmyadmin and XAMMP but on an apache server / db without XAMMP