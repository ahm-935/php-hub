<?php
require_once 'user.class.php';
class Auth {

   static public function login($_email, $_password) {
        global $db;
        $sql = "SELECT * FROM users WHERE email = '$_email'";
        $result = $db->query($sql);
        $user = $result->fetch_assoc();
        if(!$user){
            return ['error' => 'Email not found.'];
        }else{
            $password =password_verify($_password, $user['password']);
            if($password){
                return $user;
            }else{
                return ['error' => 'Password incorrect.'];
            }
            // return ['error' => password_verify($_password, $user['password'])];
        }
    }
}

?>