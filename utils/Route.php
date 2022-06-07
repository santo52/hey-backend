<?php

header("Access-Control-Allow-Origin: *");

class Route
{
    private $method = null;
    
    public static function getAll($callback = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && empty($_GET['id'])) {
            $callback ? $callback($_GET) : null;
        }
    }

    public static function getOne($callback = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $callback ? $callback($id, $_GET) : null;
        }
    }

    public static function create($callback = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $callback ? $callback($_REQUEST) : null;
        }
    }

    public static function update($callback = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT' && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $callback ? $callback($id, $_REQUEST) : null;
        }
    }

    public static function delete($callback = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $callback ? $callback($id, $_REQUEST) : null;
        }
    }
}
