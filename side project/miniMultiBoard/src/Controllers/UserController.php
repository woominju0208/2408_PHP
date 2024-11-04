<?php
namespace Controllers;

use Controllers\Controller;

class UserController extends Controller {
    protected function goLogin() {
        return 'login.php';
    }
}