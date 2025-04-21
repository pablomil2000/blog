<?php

var_dump($_SESSION);

unset($_SESSION['user']);

UtilsController::redirect('home');
