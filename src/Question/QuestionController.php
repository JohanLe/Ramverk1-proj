<?php

namespace Anax\Question;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Question\HTMLForm\CreateForm;
use Anax\Question\HTMLForm\EditForm;
use Anax\Question\HTMLForm\DeleteForm;
use Anax\Question\HTMLForm\UpdateForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class QuestionController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var $data description
     */
    //private $data;



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     ;
    // }



    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $page->add("question/crud/view-all", [
            "items" => $question->findAll(),
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }

    public function viewActionGet($question_id) : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $answer = new \Anax\Answer\Answer();
        // $comment = new \Anax\Comment\Comment();
    
        $question->setDb($this->di->get("dbqb"));
        $answer->setDb($this->di->get("dbqb"));

        /*
         - 1 Hämta alla answers till question
            Hämta alla  comments kopplade till question.

            har Comment ett answer_id kopplat? Lägg under answer id.
            Inte? Lägg under question direkt.




        */
        $quest = $question->findWhere("id = ?", [$question_id]);
        $answers = $answer->findAllWhere("question_id = ?", $question_id);
        $comments = $question->getConnectingComments("Question.id = $question_id");

        $article = $this->sortComments($quest, $answers, $comments);


        $page->add("question/crud/view-single", [
            "question" => $article[0],
            "answers" => $article[1],

        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }




    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateForm($this->di);
        $form->check();

        $page->add("question/crud/create", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a item",
        ]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return object as a response object
     */
    public function deleteAction() : object
    {
        $page = $this->di->get("page");
        $form = new DeleteForm($this->di);
        $form->check();

        $page->add("question/crud/delete", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Delete an item",
        ]);
    }



    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();

        $page->add("question/crud/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }


    public function sortComments($question, $answers, $comments)
    {
        $question->{"comments"} = [];
        foreach ($comments as $comment) {
            if ($comment->answer_id != 0) {
                foreach ($answers as $answer) {
                    if (!property_exists($answer, "comments")) {
                        $answer->{"comments"} = [];
                    }
                    if ($answer->id == $comment->answer_id) {
                        $answer->comments[] = $comment;
                    }
                }
            } else {
                $question->comments[] = $comment;
            }
        }
        return [$question, $answers];
    }
}
