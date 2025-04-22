<?php

$categoryCtrl = new categoryCtrl('categories', ['C', 'R']);
$categories = $categoryCtrl->index();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $postCtrl = new postsController('posts', ['C', 'R']);

    $status = [];

    $data['Name'] = validatorController::validateString($_POST['subject']);
    $data['Slug'] = UtilsController::getSlug(validatorController::validateString($_POST['subject']));
    $data['Content'] = $_POST['content'];

    $data['Author_id'] = $_SESSION['user']['Id'];

    $category_id = $_POST['category_id'];

    if ($_POST['category_id'] > $_POST['lastCat']) {
        $dataCategory['Name'] = validatorController::validateString($_POST['newCategory']);
        $dataCategory['Slug'] = UtilsController::getSlug(validatorController::validateString($_POST['newCategory']));

        $category_id = $categoryCtrl->create($dataCategory);
    }

    $data['Category_id'] = $category_id;
    // var_dump($_POST);


    // die();

    // var_dump($data);
    $resp = $postCtrl->create($data);
    // var_dump($resp);

    if ($resp) {
        $status['success'] = ['Post creado'];
    } else {
        $status['errors'] = ['Error al crear el post'];
    }
}

require_once './views/partials/newPost.view.php';
