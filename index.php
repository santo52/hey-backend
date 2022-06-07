<?php

require($_SERVER['DOCUMENT_ROOT'] . '/utils/Route.php');
require($_SERVER['DOCUMENT_ROOT'] . '/utils/Database.php');

$db = new Database();

Route::getAll(function() {
    $response['token'] = '1';
    echo json_encode($response);
});

Route::getOne(function() {
    $response['token'] = '2';
    echo json_encode($response);
});

Route::create(function() {
    $response['token'] = '3';
    echo json_encode($response);
});

Route::update(function() {
    $response['token'] = '4';
    echo json_encode($response);
});

Route::delete(function() {
    $response['token'] = '5';
    echo json_encode($response);
});