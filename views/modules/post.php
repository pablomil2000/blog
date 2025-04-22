<?php
$template = new TemplateController();
$url = explode('/', $_GET['url']);

if (isset($url[1]) && $url[1] != '') {
    $postCtrl = new postsController('posts', ['R']);

    $post = $postCtrl->search(['Slug' => $url[1]]);
    if ($post != []) {
        $post = $post[0];
    } else {
        UtilsController::redirect($template->baseUrl . '404');
    }
} else {
    UtilsController::redirect($template->baseUrl . '404');
}

require_once './views/partials/post.view.php';
