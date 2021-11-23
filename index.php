<?php

require_once __DIR__ . '/vendor/autoload.php';

$repository = new \Trismegiste\NameGenerator\FileRepository(__DIR__ . '/database');

$given = $repository->getGivenNameLanguage();
$surname = $repository->getSurnameLanguage();

require 'template/form.php';
