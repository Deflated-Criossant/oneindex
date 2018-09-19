<?php

class APIController
{
    function index()
    {
        header('Access-Control-Allow-Origin: *');
//        header('Content-type: application/json');
        $baseUrl = config('onedrive_root');
        if (isset($_GET['/api/path']) && substr($_SERVER['REQUEST_URI'], -1) != '/') {
            $dir = str_replace(basename($_SERVER['REQUEST_URI']), "", $_GET['/api/path']);
            $file = basename($_SERVER['REQUEST_URI']);
            $url = onedrive::dir($baseUrl . $dir)[$file]['downloadUrl'];
            if (isset($url)) {
                echo file_get_contents($url);
            } else {
                header("HTTP/1.1 400 Bad Request");
                echo json_encode(array("status" => "error", "code" => 400, "msg" => "File not found"));
            }
        } elseif (substr($_SERVER['REQUEST_URI'], -1) == '/') {
            $dir = $_GET['/api/path'];
            $files = onedrive::dir($baseUrl . $dir);
            echo json_encode($files);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(array("status" => "error", "code" => 400, "msg" => "Invalid parameters"));
        }
    }
}
