<?php
$template = new TemplateController();
$categoriesCtrl = new categoryCtrl('categories', ['R']);
$categories = $categoriesCtrl->index();
$pag = true;

$data = [];
if (isset($_GET['cat'])) {
    $category = $categoriesCtrl->search(['Slug' => $_GET['cat']]);

    $data = ['Category_id' => $category[0]['Id']];
}

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
if ($data != [] || $_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $search = validatorController::validateString($_POST['search']);
        $data['Name'] = '%' . $search . '%';
    }
    // var_dump($data);
    $posts = $postsCtrl->search($data);
    $pag = false;
} else {
    $posts = $postsCtrl->getPaginated($page);
}

// var_dump($paginationConfig);
$paginationInfo = $postsCtrl->getPaginationInfo();

// var_dump($paginationInfo);

require_once('./views/partials/home.view.php');
