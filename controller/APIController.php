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
            $url = $this->items($baseUrl . $dir)[$file]['downloadUrl'];
            if (isset($url)) {
                echo file_get_contents($url);
            }
        }
    }

    function items($path)
    {
        $items = onedrive::dir($path);
        if (is_array($items)) {
            $this->time = TIME;
        }
        return $items;
    }
}