<?php

namespace Anax\Comment\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Comment\Comment;

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
    public function __construct(ContainerInterface $di, $qid = 0, $aid = 0)
    {
        parent::__construct($di);
        if ($aid > 0) {
            $this->form->create(
                [
                    "id" => __CLASS__,
                    "legend" => "Details of the item",
                ],
                [
                    "question-id" => [
                        "type" => "text",
                        "validation" => ["not_empty"],
                        "readonly" => true,
                        "value" => $qid
                    ],
                    "answer-id" => [
                        "type" => "text",
                        "validation" => ["not_empty"],
                        "readonly" => true,
                        "value" => $aid
                    ],
                            
                    "Comment" => [
                        "type" => "textarea",
                        "validation" => ["not_empty"],
                    ],
    
                    "submit" => [
                        "type" => "submit",
                        "value" => "Create item",
                        "callback" => [$this, "callbackSubmit"]
                    ],
                ]
            );
        } else {
            $this->form->create(
                [
                    "id" => __CLASS__,
                    "legend" => "Details of the item",
                ],
                [
                    "question-id" => [
                        "type" => "text",
                        "value" => $qid,
                        "readonly" => true,
                        "validation" => ["not_empty"],
                    ],
                    "Comment" => [
                        "type" => "textarea",
                        "validation" => ["not_empty"],
                    ],
                    "submit" => [
                        "type" => "submit",
                        "value" => "Create item",
                        "callback" => [$this, "callbackSubmit"]
                    ],
                ]
            );
        }
    }

    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $userHelper = new \Anax\User\UserHelper();

        if (!$userHelper->isLoggedIn()) {
            return false;
        }

        $user = $userHelper->getUser();
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        
        $comment->userId = $user['id'];
        $comment->questionId  = $this->form->value("question-id");
        $comment->answerId = $this->form->value("answer-id") ?? 00;
        $comment->date = date("Y-m-d H:i");
        $comment->text = $this->form->value("Comment");
        $comment->save();
        return true;
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("question")->send();
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
