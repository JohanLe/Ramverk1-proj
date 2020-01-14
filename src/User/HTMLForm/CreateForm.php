<?php

namespace Anax\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\User\User;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
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
                "legend" => "Details of the item",
            ],
            [
                
                "email" => [
                    "type"        => "email",
                ],
                "username" => [
                    "type"        => "text",
                ],
        
                "password" => [
                    "type"        => "password",
                ],
        
                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],
        
                "submit" => [
                    "type" => "submit",
                    "value" => "Create user",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }




        /**
     * Random string generator for 12 character ids
     * @return String 12 character ids
     */
    function generateRandomString($length = 12) {
        return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
    }

    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
    
        $id  = $this->generateRandomString();
        $email  = $this->form->value("email");
        $password = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");
        $username = $this->form->value("username");


        $passwordAgain = $this->form->value("password-again");

        // Check password matches
        if ($password !== $passwordAgain ) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        // Save to database
        $db = $this->di->get("dbqb");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $userId = $this->generateRandomString();
        var_dump($userId);
        $db->connect()
        ->insert("User", ["id", "email", "password", "username"])
        ->execute([$userId, $email, $password, $username]);

        $this->form->addOutput("User was created.");

        //$user->save();
        return true;
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("user")->send();
    }



    // /**
    //  * Callback what to do if the form was unsuccessfully submitted, this
    //  * happen when the submit callback method returns false or if validation
    //  * fails. This method can/should be implemented by the subclass for a
    //  * different behaviour.
    //  */
    // public function callbackFail()
    // {
    //     $this->di->get("response")->redirectSelf()->send();
    // }
}
