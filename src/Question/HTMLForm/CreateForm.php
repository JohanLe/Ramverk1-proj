<?php

namespace Anax\Question\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Question\Question;

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

                "title" => [
                    "label" => "<h6 class='label'>Title </h6> ",
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],
                        
                "text" => [
                    "label" => "<h6 class='label'>Text <span>Write as Markdown</span></h6> ",
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],
                "tags" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "label" => "<h6 class='label'>Tags <span>Separate with a blankspace</h6> ",
                    "placeholder" => "tag secondTag"
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Create item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
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
        $user = $userHelper->getUser();

       

        $db = $this->di->get("dbqb");

        $tags = $this->form->value("tags");
        $title = $this->form->value("title");
        $text  = $this->form->value("text");
        $date = date("Y-m-d H:i");       
        $user_id  = $user["id"];
        $question_id = $this->generateRandomId();
        

        
        $db->connect()
        ->insert("Question", ["id", "title", "text", "user_id", "date"])
        ->execute([$question_id, $title, $text, $user_id, $date ]);
        
        $this->insertTags($db, $tags, $question_id);

        $this->form->addOutput("Question was created.");
       
        return false;
    }


    public function insertTags($db, $tags, $question_id){

        $tag = new \Anax\Tag\Tag();
        $tag->setDb($this->di->get("dbqb"));


        
        $tagArray = explode(" ", $tags);

        foreach($tagArray as $tagText){

            $tag_id = $this->generateRandomId();
            $tagExist = $tag->findWhere("text = ?", "$tagText");

            if($tagExist->id == null){
             
                $db->connect()
                ->insert("tag", ["id", "text"])
                ->execute([$tag_id, $tagText]);

                $db->connect()
                ->insert("Tag_Activity", ["tag_id", "question_id"])
                ->execute([$tag_id, $question_id]);

            } else{
                $db->connect()
                ->insert("Tag_Activity", ["tag_id", "question_id"])
                ->execute([$tagExist->id, $question_id]);
            }

            
        }
    }

    public function generateRandomId($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
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
