<?php
$template = new TemplateController();
$url = explode('/', $_GET['url']);

$categoryCtrl = new categoryCtrl('categories', ['C', 'R']);
$categories = $categoryCtrl->index();

if (isset($url[1]) && $url[1] != '') {
    $postCtrl = new postsController('posts', ['R', 'U', 'D']);

    $post = $postCtrl->search(['Slug' => $url[1]]);
    if (!empty($post)) {
        $post = $post[0];

        // Verificamos si hay un 3er parámetro (acción)
        if (isset($url[2]) && $url[2] != '') {
            $action = $url[2];

            switch ($action) {
                case 'edit':
                    // Lógica para editar

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

                        // var_dump($post['Id'], $data);
                        if ($postCtrl->update($post['Id'], $data)) {
                            $status['success'] = ['Post actualizado'];
                            header('location: ' . $template->baseUrl . 'post/' . $data['Slug']);
                        } else {
                            $status['errors'] = ['Error al actualizar el post'];
                        }
                    }

                    require_once './views/partials/edit.view.php';
                    exit;

                case 'delete':

                    var_dump($postCtrl->delete(['id' => $post['Id']]));
                    UtilsController::redirect($template->baseUrl . 'home'); // redirige a lista de posts
                    exit;

                default:
                    // Acción no reconocida
                    UtilsController::redirect($template->baseUrl . '404');
                    exit;
            }
        }
    } else {
        UtilsController::redirect($template->baseUrl . '404');
    }
} else {
    UtilsController::redirect($template->baseUrl . '404');
}

// Si no hay acción, mostrar el post normalmente
require_once './views/partials/post.view.php';
