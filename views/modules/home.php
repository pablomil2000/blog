<?php
$template = new TemplateController();

$pag = true;

if (isset($_GET['url'])) {
    $parametres = explode('/', $_GET['url']);
    if (isset($parametres[1])) {
        $page = $parametres[1];
    } else {
        $page = 1;
    }
} else {
    $page = 1;
}


$paginationConfig = [
    'xPage' => '2',
    'page' => $page
];

$postsCtrl = new postsController('posts', ['R'], $paginationConfig);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = validatorController::validateString($_POST['search']);
    $posts = $postsCtrl->search(['Name' => '%' . $search . '%']);
    $pag = false;
} else {
    $posts = $postsCtrl->getPaginated($page);
}

// var_dump($paginationConfig);
$paginationInfo = $postsCtrl->getPaginationInfo();

// var_dump($paginationInfo);

require_once('./views/partials/home.view.php');
