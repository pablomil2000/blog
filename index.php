<?php
session_start();

require_once './controllers/utils.controller.php';

require_once './controllers/template.controller.php';
require_once './models/conection.model.php';
require_once './models/crud.model.php';

require_once './controllers/crud.controller.php';


// var_dump($_GET);
if (isset($_GET['url']) && str_starts_with($_GET['url'], 'api')) {
  require_once './controllers/api.controller.php';
  die();
}

$template = new TemplateController();

// var_dump($_SESSION);

// if (!isset($_SESSION['user'])) {
//   $template->logintemplate();
// } else {
//   $template->render();
// }

$template->render();
