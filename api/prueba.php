<?php

require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Route.php');
require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Database.php');



Route::getAll(function($request) {
    $db = new Database();
    $data = $db->query("SELECT * FROM prueba")->resultset();
    /** Opcion 2
     * $data = $db->query("SELECT * FROM prueba")
     * $data = $data->resultset();
     */
    echo json_encode($data);
});

Route::getOne(function($id, $request) {
      $db = new Database();
    $data = $db->query("SELECT * FROM prueba where id_prueba='" . $id . "'")->single();
    /** Opcion 2
     * $data = $db->query("SELECT * FROM prueba where id_prueba=1")
     * $data = $data->single();
     */
    echo json_encode($data);
});

Route::create(function($request) {
      $db = new Database();
    $db->query("INSERT INTO prueba (name) VALUES ('{$request['name']}')")->execute();
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
      $db = new Database();
    $db->query("UPDATE prueba SET name ='{$request['name']}' WHERE id_prueba={$request['id']}")->execute();
    $data = $db->query("SELECT * FROM prueba where id_prueba='" . $id . "'")->single();
    $response['data'] = $data;
    $response['updated'] = true;
    $response['id'] = $id;
    echo json_encode($response);
});

Route::delete(function($id, $request) {
      $db = new Database();
      $db ->query("DELETE FROM prueba WHERE id_prueba='{$id}'")->execute();
      $response['deleted'] = true;
      $response['id'] = $id;
    echo json_encode($response);
});