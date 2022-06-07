<?php

require($_SERVER['DOCUMENT_ROOT'] . '/utils/Route.php');
require($_SERVER['DOCUMENT_ROOT'] . '/utils/Database.php');

$db = new Database();

Route::getAll(function($request) {
    $data = $db->query("SELECT * FROM prueba")->resultset();
    /** Opcion 2
     * $data = $db->query("SELECT * FROM prueba")
     * $data = $data->resultset();
     */
    echo json_encode($data);
});

Route::getOne(function($id, $request) {
    $data = $db->query("SELECT * FROM prueba where id_prueba='" . $id . "'")->single();
    /** Opcion 2
     * $data = $db->query("SELECT * FROM prueba where id_prueba=1")
     * $data = $data->single();
     */
    echo json_encode($data);
});

Route::create(function($request) {
    $db->query("INSERT INTO prueba (name) VALUES ('este es un nombre')")->execute();
    /** Opcion 2
     * $data = $db->query("INSERT INTO prueba (name) VALUES ('este es un nombre')");
     * $data->execute();
     */

    $id = $db->lastInsertId();
    $data = $db->query("SELECT * FROM prueba where id_prueba='" . $id . "'")->single();
    $response['data'] = $data;
    $response['created'] = true;
    $response['id'] = $id;
    echo json_encode($response);
});

Route::update(function($id, $request) {
    $db->query("UPDATE prueba SET name='nameeee' WHERE id=1")->execute();
    $data = $db->query("SELECT * FROM prueba where id_prueba='" . $id . "'")->single();
    $response['data'] = $data;
    $response['updated'] = true;
    $response['id'] = $id;
    echo json_encode($response);
});

Route::delete(function($id, $request) {
    $response['token'] = '5';
    echo json_encode($response);
});