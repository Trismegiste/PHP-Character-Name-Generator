<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Trismegiste\NameGenerator\App;

$request = Request::createFromGlobals();
$app = new App();

if ($request->getMethod() === 'GET') {
    $response = $app->form();
} else if ($request->getMethod() === 'POST') {
    $response = $app->result($request);
} else {
    $html = '<html><body><h1>Page Not Found</h1></body></html>';
    $response = new Response($html, Response::HTTP_NOT_FOUND);
}

$response->send();
