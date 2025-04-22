<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $postCtrl = new postsController('posts', ['C', 'R']);

    $status = [];

    $data['Name'] = validatorController::validateString($_POST['subject']);
    $data['Slug'] = UtilsController::getSlug(validatorController::validateString($_POST['subject']));
    $data['Content'] = $_POST['content'];

    $data['Author_id'] = $_SESSION['user']['Id'];

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
