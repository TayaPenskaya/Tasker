<?php


namespace App\Core;


class View {
    private string $path;

    public function __construct($route) {
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($params = []) {
        extract($params);
        ob_start();
        require 'public/styles/index.css';
        $style = ob_get_clean();
        ob_start();
        require 'public/scripts/index.js';
        $script = ob_get_clean();
        ob_start();
        require 'src/views/'.$this->path.'.php';
        $content = ob_get_clean();
        require 'src/views/template.php';
    }

    public function redirect($url) {
        header('location: '.$url);
        exit;
    }

    public static function error($message = '', $code = 404) {
        http_response_code($code);
        ob_start();
        require 'public/styles/index.css';
        $style = ob_get_clean();
        ob_start();
        require 'src/views/errors/error.php';
        $content = ob_get_clean();
        require 'src/views/template.php';
        exit;
    }
}