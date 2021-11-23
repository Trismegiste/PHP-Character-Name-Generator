<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Trismegiste\NameGenerator\FileRepository;
use Trismegiste\NameGenerator\RandomizerDecorator;

$request = Request::createFromGlobals();

$numberNames = $request->request->get("theNamesDisplayed", 50);
$givenName = $request->request->get("theGivenName");
$surname = $request->request->get("theSurname");
$gender = $request->request->get("theGender");
$totallyRandomName = $request->request->get("theTotallyRandomName", 0);

if ($totallyRandomName == 1) {
    $givenName = 'random';
    $surname = 'random';
}

// generating
$repository = new RandomizerDecorator(new FileRepository(__DIR__ . '/../database'));

$nameGenerated = [];
for ($k = 0; $k < $numberNames; $k++) {
    // listings are cached, therefore, it's ok to call the same language again and again
    $surnameList = $repository->getSurnameListFor($surname);
    $givenList = $repository->getGivenNameListFor($gender, $givenName);

    $nameGenerated[] = $givenList[random_int(0, count($givenList) - 1)] .
        ' ' . $surnameList[random_int(0, count($surnameList) - 1)];
}

require '../template/result.php';
