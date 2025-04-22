<?php

class postsController extends CrudController
{

    public function getAuthor($autor)
    {
        $UsersCtrl = new UsersController('users', ['R']);
        $user = $UsersCtrl->search(['id' => $autor]);

        if ($user == []) {
            return "Desconocido";
        } else {
            return $user[0]['Name'];
        }
    }

    public function getCategory($id)
    {
        $categoryCtrl = new categoryCtrl('categories', ['R']);
        $category = $categoryCtrl->search(['Id' => $id]);

        if ($category == []) {
            return "Desconocida";
        } else {
            return $category[0]['Name'];
        }
    }
}
