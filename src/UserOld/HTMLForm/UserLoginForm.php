<?php

namespace Anax\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "User Login"
            ],
            [
                "email" => [
                    "type"        => "email",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],
                        
                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }


    /**
     * TODO: - Move to own class? same with logout.
     *        Also check function - if user is allowed on page?
     * Save user to session, mark user as logged in.
     * 
     */

    public function userLoggedIn($email){
        $_SESSION['user_email'] = $email;
    }

        /**
     * TODO: - Move to own class? same with login.
     *        Also check function - if user is allowed on page?
     * Remove user from session, mark user as logged out.
     * 
     */

    public function userLoggOut($user){
        $_SESSION['user_email'] = null;
    }

    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
    // Get values from the submitted form
    $email       = $this->form->value("email");
    $password    = $this->form->value("password");

    // Try to login
    $db = $this->di->get("dbqb");
    $db->connect();
    $user = $db->select("password")
               ->from("User")
               ->where("email = ?")
               ->execute([$email])
               ->fetch();

    // $user is null if user is not found
    if (!$user || !password_verify($password, $user->password)) {
       $this->form->rememberValues();
       $this->form->addOutput("email or password did not match.");
       return false;
    }

    $this->form->addOutput("User logged in.");
    $this->userLoggedIn($email); // change to id/email
    
    return true;
    }
}
