<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 16.05.17
 * Time: 22:20
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require_once './api.php';

$app = new \Slim\App;
$api = new api();
// get
$app->get('/get_ALL', function (Request $request, Response $response) {

    global $api;
    $result = $api->get_ALL();
    $response->getBody()->write($result);

    return $response;
});

$app->get('/get_popular', function (Request $request, Response $response) {

    global $api;
    $result = $api->get_popular();
    $response->getBody()->write($result);

    return $response;
});

$app->get('/get_feedbacks', function (Request $request, Response $response) {

    global $api;
    $result = $api->get_feedbacks();
    $response->getBody()->write($result);

    return $response;
});

$app->get('/get_instagram', function (Request $request, Response $response) {

    global $api;
    $result = $api->get_instagram();
    $response->getBody()->write($result);

    return $response;
});

// POST
$app->post('/visit_page/{id}', function (Request $request, Response $response) {

    global $api;
    $id = $request->getAttribute('id');
    $api->visit_page($id);
});


//todo  use some library for mail send (should be checked)
$app->post('/send_mail', function (Request $request, Response $response) {

    global $api;
    $data = $request->getParsedBody();
    $mail_data = filter_var($data['mail'], FILTER_SANITIZE_STRING);
    $api->send_mail($mail_data);
});

$app->run();
