<?php

use Framework\Http\ResponseSender;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$request = ServerRequestFactory::fromGlobals();

$name = $request->getQueryParams()['name'] ?? 'People';

$response = (new HtmlResponse('Hello, '. $name . '!'))
    ->withHeader('X-Developer','ElisDN');

$emitter = new ResponseSender();
$emitter->send($response);
