<?php
$userCtrl = new UsersController('users', ['C', 'R']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [];
    $status = [];

    $data['Name'] = validatorController::validateString($_POST['username']);
    $data['Email'] = validatorController::validateString($_POST['email']);

    if ($_POST['password'] == $_POST['confirmation']) {
        $data['Password'] = $_POST['password'];

        try {
            $users = $userCtrl->create($data);
            $status['success'] = ['Usuario creado'];
            UtilsController::redirect('login');
        } catch (\Throwable $th) {
            $status['errors'] = ['No se pudo crear el usuario'];
        }

        var_dump($data);
    } else {
        $status['errors'] = ["Las contraseñas no coinciden"];
    }
}

include_once './views/partials/signup.view.php';
