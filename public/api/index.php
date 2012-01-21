<?php

include_once './../../init.php';
include_once 'tonic.php';
include_once 'Log.php';

$request = new Request(array(
    'baseUri' => '/api'
));

try {
    $resource = $request->loadResource();
    $response = $resource->exec($request);
} catch (ResponseException $e) {
    $response = $e->response($request);
}

$response->output();