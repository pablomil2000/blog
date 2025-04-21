<?php
UtilsController::GuestRequired('home');

$usersCtrl = new UsersController('users', ['R']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [];
    $status = [];

    $data['Email'] = validatorController::validateString($_POST['email']);
    $data['Password'] = $_POST['password'];
    $data['status'] = 1;

    $user = $usersCtrl->search($data);

    // var_dump($user);
    if (isset($user[0]['Id'])) {
        $status['success'] = ['Login complete'];

        $_SESSION['user'] = [
            'Id' => $user[0]['Id'],
            'Name' => $user[0]['Name'],
            'Role_id' => $user[0]['Role_id']
        ];

        UtilsController::redirect('home');
    } else {
        $status['errors'] = ['Datos erroneos'];
    }
}

include_once './views/partials/login.view.php';
