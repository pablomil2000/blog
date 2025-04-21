<?php

class TemplateController
{

    public $view;
    public $baseUrl = null;

    public function __construct($view = 'template')
    {
        $env = parse_ini_file('.env');
        $this->baseUrl = $env['BaseURL'];

        $GLOBALS['baseUrl'] = $this->baseUrl;

        $this->view = $view;
    }

    public function render()
    {
        require_once 'views/templates/' . $this->view . '.php';
    }

    public function whitelist(...$routeValid)
    {

        if (isset($_GET['url'])) {
            $url = explode("/", $_GET["url"]);
        } else {
            $url[] = 'home';
        }

        $routeValid[] = 'home';
        if (in_array($url[0], $routeValid)) {
            $redirect = $url[0];
        } else {
            $redirect = 'errors/404';
        }
        // var_dump($redirect);

        require_once('./views/modules/' . $redirect . '.php');
        return $url;
    }

    public function whitelistLogin(...$routeValid)
    {


        if (isset($_GET['url'])) {
            $url = explode("/", $_GET["url"]);
        } else {
            $url[] = 'login';
        }

        $routeValid[] = 'login';
        if (in_array($url[0], $routeValid)) {
            $redirect = $url[0];
        } else {
            $redirect = 'errors/404';
        }
        // var_dump($redirect);

        require_once('./views/modules/' . $redirect . '.php');
        return $url;
    }

    public function logintemplate()
    {
        require_once 'views/templates/logintemplate.php';
    }
}
