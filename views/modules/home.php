<?php
$template = new TemplateController();

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


// var_dump($paginationConfig);

$postsCtrl = new postsController('posts', ['R'], $paginationConfig);
$posts = $postsCtrl->getPaginated($page);
$paginationInfo = $postsCtrl->getPaginationInfo();
// var_dump($paginationInfo);

require_once('./views/partials/home.view.php');
