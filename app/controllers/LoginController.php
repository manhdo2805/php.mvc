<?php

class LoginController {
    public function login() {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        $user = $_POST['username'];
        $pass = $_POST['password'];

        $ret = User ::auth($user,$pass);

        echo "<pre>";
        print_r($ret);
        echo "</pre>";
       
        require '../app/views/login.php';
}   
     public function logiout() {
       
}
}
