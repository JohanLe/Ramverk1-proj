<?php

namespace Anax\User;

class UserHelper
{

    /**
     * Loggout user and set session variable to null.
     */
    public function logout()
    {
        $_SESSION['username'] = null;
        $_SESSION['user_email'] = null;
        $_SESSION['user_id'] = null;
    }


    /**
     * Loggin user and set session variables
     */

    public function login($userId, $username, $email)
    {
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['user_email'] = $email;
    }


    /**
     * @return Object with userdata
     */
    public function getUser()
    {
        if ($_SESSION['user_id'] == null) {
            return null;
        }

        $user = [
            "id" => $_SESSION['user_id'],
            "username" => $_SESSION['username'],
            "email" => $_SESSION['user_email']
        ];
        return $user;
    }


    /**
     * Returns text string with username if logged in.
     */
    public function logedInAs()
    {
        if ($_SESSION['username'] == null) {
            return "";
        }
        return;
        "<img src='{$this->getGravatar()}' caption='gravatar'>".
        "</br>User: " . $_SESSION['username'];
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }

    public function getGravatar($size = 80, $dpx = 'mp', $rad = 'g', $img = false, $atts = array())
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($_SESSION['user_email'])));
        $url .= "?s=$size&d=$dpx&r=$rad";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
                $url .= ' />';
            }
        }
        return $url;
    }
}
